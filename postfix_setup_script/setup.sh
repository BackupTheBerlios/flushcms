#!/bin/sh
# $Id: setup.sh,v 1.14 2006/01/01 06:18:53 arzen Exp $
PATH=/bin:/sbin:/usr/bin:/usr/sbin:/usr/local/bin:/usr/local/sbin

# Linux Server Setup Script v2.0
# 2005-11-26 
# Copyright (C) 2004 by (John.meng)ÃÏÔ¶òû
# E-mail:arzen1013@yahoo.com.cn QQ:3440895
# Warning !! This script only for Red hat Linux 9.0,unknow use other system.

_INSTALL_APACHE="n" 
_INSTALL_MYSQL="n" 
_INSTALL_LIBXML2="n" 
_INSTALL_PHP="n" 
_INSTALL_PHP5="n" 
_INSTALL_POSTFIX="y" 
_INSTALL_PAM_MYSQL="y" 
_INSTALL_CYRUSIMAP="n" 
_INSTALL_PCRE="n" 
_INSTALL_COURIERAUTHLIB="n" 
_INSTALL_COURIERIMAP="n" 
_INSTALL_MAILDROP="n" 

_INSTALL_LIBIDN="n" 
_INSTALL_BOOST="n" 
_INSTALL_PUREFTPD="n" 
_INSTALL_JABBERD2="n" 
_INSTALL_POWERDNS="n"
_SET_SECURITY="n"

_INSTALL_DOMAIN_NAME="518ic.com" 
_TODO_METHOD="INSTALL" 
_INSTALL_LOG="/var/uninstall/linux_server_install.log" 
_UNINSTALL_LOG="/var/uninstall/linux_server_uninstall.log" 


_OS="Linux"
_START_DATE=`date +"%Y-%m-%d %H:%M:%S"`
_SOURCE_DIR=`pwd`

echo " "
echo " "
echo "+---------------------------------------------------------+";
echo "|         Linux Server Setup Script v2.0                  |";
echo "|         2005 11 2                                       |";
echo "|         compile by ÃÏÔ¶òû                               |";
echo "|         Copyright (C) 2004 by arzen                     |";
echo "|         E mail:arzen1013@yahoo.com.cn QQ:3440895        |";
echo "+---------------------------------------------------------+";
echo " ";
echo " ";
echo "Start Time:$_START_DATE ";
echo " ";
echo " ";
echo "Source Dir:$_SOURCE_DIR ";
echo " ";
echo " ";

mkdir -p /var/uninstall

function checkSystem()
{
	echo "==> Start check your system ... ";

	OS=`uname -s`
	if [ "$OS" != "$_OS" ]; then
	echo "Your system is $OS"
	echo "Please set _OS for $OS."
	exit 0
	fi
	echo "Checking...for root"
	QUID=`whoami`
	if [ "$QUID" != "root" ]; then
	echo 'Sorry,Please su to "root"'
	exit 0
	fi
	echo "Checking...for gcc"
	which gcc
	if [ "$?" = 1 ]; then
	echo 'Sorry,Your system not "gcc" program!'
	exit 0
	fi
	echo "Checking...for g++"
	which g++
	if [ "$?" = 1 ]; then
	echo 'Sorry,Your system not "g++" program!'
	exit 0
	fi
	echo "Checking...for make"
	which make
	if [ "$?" = 1 ]; then
	echo 'Sorry,Your system not "make" program!'
	exit 0
	fi
	echo "Checking...for perl"
	which perl
	if [ "$?" = 1 ]; then
	echo 'Sorry,Your system not "perl" program!'
	exit 0
	fi

}


function removeOldSendmail()
{
	echo "==> Start remove old sendmail ... ";
	mv /usr/sbin/sendmail /usr/sbin/sendmail.OFF >>/var/uninstall/postfix_install.log 2>&1
	mv /usr/bin/newaliases /usr/bin/newaliases.OFF >>/var/uninstall/postfix_install.log 2>&1
	mv /usr/bin/mailq /usr/bin/mailq.OFF >>/var/uninstall/postfix_install.log 2>&1
	chmod 755 /usr/sbin/sendmail.OFF /usr/bin/newaliases.OFF /usr/bin/mailq.OFF >>/var/uninstall/postfix_install.log 2>&1
	rpm -e fetchmail-6.2.0-3
	rpm -e mutt-1.4-10
	rpm -e sendmail
}

function createMysqlDB()
{
	mysql < mail.sql
}

function configMysqlPAM()
{

	[ -f /etc/pam.d/mail ] && mv /etc/pam.d/mail /etc/pam.d/mail.arzen.orig
	cp mail /etc/pam.d/mail

	[ -f /etc/pam.d/imap ] && mv /etc/pam.d/imap /etc/pam.d/imap.arzen.orig
	ln -s /etc/pam.d/mail /etc/pam.d/imap

	[ -f /etc/pam.d/pop ] && mv /etc/pam.d/pop /etc/pam.d/pop.arzen.orig
	ln -s /etc/pam.d/mail /etc/pam.d/pop

	[ -f /etc/pam.d/smtp ] && mv /etc/pam.d/smtp /etc/pam.d/smtp.arzen.orig
	ln -s /etc/pam.d/mail /etc/pam.d/smtp

	[ -f /etc/pam.d/sieve ] && mv /etc/pam.d/sieve /etc/pam.d/sieve.arzen.orig
	ln -s /etc/pam.d/mail /etc/pam.d/sieve

	echo pwcheck_method: saslauthd > /usr/lib/sasl2/smtpd.conf
	echo mech_list: plain login >> /usr/lib/sasl2/smtpd.conf

	sed -e "s/MECH=shadow/MECH=pam/" -r -i.org /etc/init.d/saslauthd
}

function getPamMysql()
{
	# need pam-devel
	if [ ! -f pam_mysql-0.6.0.tar.gz ] ; then
		wget http://jaist.dl.sourceforge.net/sourceforge/pam-mysql/pam_mysql-0.6.0.tar.gz
	fi

	if [ -f pam_mysql-0.6.0.tar.gz ]; then
		rm -rf pam_mysql-0.6.0
		tar xvfz pam_mysql-0.6.0.tar.gz || return 1
		cd pam_mysql-0.6.0
		./configure --with-pam-mods-dir=/lib/security --with-pam --with-cyrus-sasl2 --with-mysql=/usr/local/
		make install
		cd ..
	fi
}

function getPamMysql50()
{
	# need pam-devel
	if [ ! -f pam_mysql-0.5.tar.gz ] ; then
		wget http://switch.dl.sourceforge.net/sourceforge/pam-mysql/pam_mysql-0.5.tar.gz || return 1
	fi

	if [ -f pam_mysql-0.5.tar.gz ]; then
		rm -rf pam_mysql-0.5
		tar xvfz pam_mysql-0.5.tar.gz || return 1
		cd pam_mysql
		make
		cp pam_mysql.so /lib/security
		cd ..
	fi
}

function getCyradm()
{
	if [ ! -f web-cyradm-0.5.4-1.tar.gz ] ; then
		wget http://www.web-cyradm.org//web-cyradm-0.5.4-1.tar.gz || return 1
	fi

	if [ -f web-cyradm-0.5.4-1.tar.gz ]; then
		rm -rf web-cyradm-0.5.4-1
		tar xvfz web-cyradm-0.5.4-1.tar.gz || return 1
		mv web-cyradm-0.5.4-1 /usr/local/apache2/htdocs/cyradm
		cd config
		cp conf.php.dist conf.php
		touch /var/log/web-cyradm-login.log
		chown nobody /var/log/web-cyradm-login.log
		cd ../scripts
		mysql --databases mail < create_mysql.sql
	fi
}

function getHorde()
{
	if [ ! -f horde-3.0.6.tar.gz ] ; then
		wget http://ftp.horde.org/pub/horde/horde-3.0.6.tar.gz || return 1
	fi

	if [ -f horde-3.0.6.tar.gz ]; then
		rm -rf horde-3.0.6
		tar xvfz horde-3.0.6.tar.gz || return 1
		mv horde-3.0.6 /usr/local/apache2/htdocs/horde
		mysql < /usr/local/apache2/htdocs/horde/scripts/sql/create.mysql.sql
		cd /usr/local/apache2/htdocs/horde/config
		for foo in *.dist; do cp $foo `basename $foo .dist`;done
	fi
}

function getPear13()
{
	if [ ! -f pear-1.3.tar.gz ] ; then
		wget ftp://ftp.horde.org/pub/pear/pear-1.3.tar.gz || return 1
	fi

	if [ -f pear-1.3.tar.gz ]; then
		rm -rf pear-1.3
		tar xvfz pear-1.3.tar.gz || return 1
		mv pear /usr/local/lib/
	fi
}

function getIMP3404()
{
	if [ ! -f imp-h3-4.0.4.tar.gz ] ; then
		wget ftp://ftp.horde.org/pub/imp/imp-h3-4.0.4.tar.gz || return 1
	fi

	if [ -f imp-h3-4.0.4.tar.gz ]; then
		rm -rf imp-h3-4.0.4
		tar xvfz imp-h3-4.0.4.tar.gz || return 1
		mv imp-h3-4.0.4 /usr/local/apache2/htdocs/horde/imp
		cd /usr/local/apache2/htdocs/horde/imp/config
		for foo in *.dist; do cp $foo `basename $foo .dist`;done
	fi
}

function getTurba3204()
{
	if [ ! -f turba-h3-2.0.4.tar.gz ] ; then
		wget ftp://ftp.horde.org/pub/turba/turba-h3-2.0.4.tar.gz || return 1
	fi

	if [ -f turba-h3-2.0.4.tar.gz ]; then
		rm -rf turba-h3-2.0.4.tar.gz
		tar xvfz turba-h3-2.0.4.tar.gz || return 1
		mv turba-h3-2.0.4 /usr/local/apache2/htdocs/horde/turba
		cd /usr/local/apache2/htdocs/horde/turba/config
		for foo in *.dist; do cp $foo `basename $foo .dist`;done
	fi
}

function getOpenssl()
{
	if [ ! -f openssl-0.9.7i.tar.gz ] ; then
		wget http://www.openssl.org/source/openssl-0.9.7i.tar.gz || return 1
	fi

	if [ -f openssl-0.9.7i.tar.gz ]; then
		rm -rf openssl-0.9.7i
		tar xvfz openssl-0.9.7i.tar.gz || return 1
		cd openssl-0.9.7i
		./config
		make
		make test
		make install
		cd ..
	fi
}

function getSqwebmail()
{
	if [ ! -f sqwebmail-5.0.6.tar.bz2 ] ; then
		wget http://belnet.dl.sourceforge.net/sourceforge/courier/sqwebmail-5.0.6.tar.bz2 || return 1
	fi

	if [ -f sqwebmail-5.0.6.tar.bz2 ]; then
		rm -rf openssl-0.9.7i
		tar xvfz sqwebmail-5.0.6.tar.bz2 || return 1
		cd openssl-0.9.7i
		./config
		make
		make test
		make install
		cd ..
	fi
}

function getCyrusIMAP()
{
	echo "==> Start CyrusIMAP install ... ";
	if [ ! -f cyrus-imapd-2.1.17.tar.gz ]; then


		wget ftp://ftp.andrew.cmu.edu/pub/cyrus-mail/cyrus-imapd-2.1.17.tar.gz || return 1

	fi

	if [ -f cyrus-imapd-2.1.17.tar.gz ]; then

		rm -rf cyrus-imapd-2.1.17
		tar vxzf cyrus-imapd-2.1.17.tar.gz || return 1
		cd cyrus-imapd-2.1.17
		env CPPFLAGS=-I/usr/kerberos/include 

		./configure --with-cyrus-prefix=/usr/cyrus --with-sasl=/usr/lib/sasl2 --with-auth=unix --without-ucdsnmp --with-krb=/usr/kerberos --with-openssl=/usr/local/ssl/
		make depend
		make all CFLAGS=-O
		make install
		cd perl/imap
		perl Makefile.PL
		make install
		cd ../..
		cp master/conf/normal.conf /etc/cyrus.conf
		useradd -g mail -M -s/no/shell -d/var/imap cyrus
		passwd cyrus

		cd ..
		[ -f /etc/imapd.conf ] && mv /etc/imapd.conf /etc/imapd.conf.arzen.orig
		cp imapd.conf /etc/imapd.conf

		mkdir -p /var/imap/sieve
		mkdir /var/spool/imap
		chown -R cyrus:mail /var/imap
		chown -R cyrus:mail /var/spool/imap
		su -s/bin/bash cyrus
		cd cyrus-imapd-2.1.17
		tools/mkimap
		exit

		echo local6.debug /var/log/imapd.log >> /etc/syslog.conf
		echo auth.debug /var/log/auth.log >> /etc/syslog.conf
		/etc/rc.d/init.d/syslog restart

		chattr -R +S /var/imap/user
		chattr -R +S /var/imap/quota
		chattr -R +S /var/spool/imap

		ln -s /usr/cyrus/bin/master /usr/cyrus/bin/cyrusd
		/usr/cyrus/bin/cyrusd&
	fi
	return 0
}

function getPCRE()
{
	echo " " >>$_INSTALL_LOG 2>&1;
	echo "==> Start PCRE install ... " >>$_INSTALL_LOG 2>&1;
	echo " " >>$_INSTALL_LOG 2>&1;
	if [ ! -f pcre-6.3.tar.gz ]; then


		wget http://jaist.dl.sourceforge.net/sourceforge/pcre/pcre-6.3.tar.gz || return 1

	fi

	if [ -f pcre-6.3.tar.gz ]; then

		sh mysleep.sh &        
		EID=$!

		if [ ! -d pcre-6.3 ];then
			tar vxzf pcre-6.3.tar.gz >>$_INSTALL_LOG 2>&1 || return 1
		fi
		cd pcre-6.3
		./configure >>$_INSTALL_LOG 2>&1
		make >>$_INSTALL_LOG 2>&1
		make install >>$_INSTALL_LOG 2>&1
		cd ..

		kill $EID >/dev/null 2>&1

	fi
	return 0
}

function getMailDrop()
{
	echo " ";
	echo -n $"==> Start MailDrop install ... "
	echo " ";
	userdel maildrop >>$_INSTALL_LOG 2>&1
	groupdel maildrop >>$_INSTALL_LOG 2>&1
	groupadd -g 450 maildrop >>$_INSTALL_LOG 2>&1
	useradd -g 450 -u 450 -c maildrop -M -d/data/mail -s/no/shell maildrop >>$_INSTALL_LOG 2>&1

	if [ ! -f maildrop-2.0.1.tar.bz2  ] ; then
		wget http://ovh.dl.sourceforge.net/sourceforge/courier/maildrop-2.0.1.tar.bz2  || return 1
	fi

	if [ -f maildrop-2.0.1.tar.bz2  ]; then
		sh mysleep.sh &        
		EID=$!

		if [ ! -d maildrop-2.0.1 ];then
			tar xvfj maildrop-2.0.1.tar.bz2 >>$_INSTALL_LOG 2>&1 || return 1 
		fi
		cd maildrop-2.0.1
		./configure --without-db --enable-sendmail=/usr/sbin/sendmail --enable-trusted-users='root maildrop' --enable-maildropmysql --with-mysqlconfig=/etc/maildrop.mysql --enable-maildirquota --with-trashquota --with-dirsync >>$_INSTALL_LOG 2>&1
		make >>$_INSTALL_LOG 2>&1
		make install >>$_INSTALL_LOG 2>&1
		make install-man >>$_INSTALL_LOG 2>&1
		cd ..
		cp courier_conf/maildrop.mysql /etc/maildrop.mysql >>$_INSTALL_LOG 2>&1

		kill $EID >/dev/null 2>&1
	fi
}

function getMailDrop163()
{
	echo " ";
	echo -n $"==> Start MailDrop163 install ... "
	echo " ";
	userdel maildrop >>$_INSTALL_LOG 2>&1
	groupdel maildrop >>$_INSTALL_LOG 2>&1
	groupadd -g 450 maildrop >>$_INSTALL_LOG 2>&1
	useradd -g 450 -u 450 -c maildrop -M -d/data/mail -s/no/shell maildrop >>$_INSTALL_LOG 2>&1

	if [ ! -f maildrop-1.6.3.tar.bz2  ] ; then
		wget http://ovh.dl.sourceforge.net/sourceforge/courier/maildrop-1.6.3.tar.bz2  || return 1
	fi

	if [ -f maildrop-1.6.3.tar.bz2  ]; then
		sh mysleep.sh &        
		EID=$!

		if [ ! -d maildrop-1.6.3 ];then
			tar xvfj maildrop-1.6.3.tar.bz2 >>$_INSTALL_LOG 2>&1 || return 1 
		fi
		cd maildrop-1.6.3
		./configure --without-db --enable-sendmail=/usr/sbin/sendmail --enable-trusted-users='root maildrop' --enable-maildropmysql --with-mysqlconfig=/etc/maildrop.mysql --enable-maildirquota --with-trashquota --with-dirsync >>$_INSTALL_LOG 2>&1
		make >>$_INSTALL_LOG 2>&1
		make install >>$_INSTALL_LOG 2>&1
		make install-man >>$_INSTALL_LOG 2>&1
		cd ..
		cp courier_conf/maildrop.mysql /etc/maildrop.mysql >>$_INSTALL_LOG 2>&1

		kill $EID >/dev/null 2>&1
	fi
}

function getCourierAuthlib()
{
	echo " " >>$_INSTALL_LOG 2>&1
	echo "==> Start CourierAuthlib install ... " >>$_INSTALL_LOG 2>&1
	echo " " >>$_INSTALL_LOG 2>&1
	if [ ! -f courier-authlib-0.57.tar.bz2 ]; then


		wget http://jaist.dl.sourceforge.net/sourceforge/courier/courier-authlib-0.57.tar.bz2 || return 1

	fi

	if [ -f courier-authlib-0.57.tar.bz2 ]; then
		sh mysleep.sh &        
		EID=$!

		if [ ! -f courier-authlib-0.57 ];then
			tar jxvf courier-authlib-0.57.tar.bz2 || return 1 >>$_INSTALL_LOG 2>&1 
		fi

		cd courier-authlib-0.57
		./configure --with-redhat --with-authmysql=yes >>$_INSTALL_LOG 2>&1
		make >>$_INSTALL_LOG 2>&1
		make install >>$_INSTALL_LOG 2>&1
		make install-configure >>$_INSTALL_LOG 2>&1
		cp courier-authlib.sysvinit /etc/init.d/courier-authlib >>$_INSTALL_LOG 2>&1
		chmod 755 /etc/init.d/courier-authlib >>$_INSTALL_LOG 2>&1
		cd ..
		cp authdaemonrc /usr/local/etc/authlib/ >>$_INSTALL_LOG 2>&1
		cp authmysqlrc /usr/local/etc/authlib/ >>$_INSTALL_LOG 2>&1
		authdaemond start >>$_INSTALL_LOG 2>&1
		
		kill $EID >/dev/null 2>&1
	fi
	return 0
}


function getCourierImap()
{
	echo " " >>$_INSTALL_LOG;
	echo "==> Start CourierImap install ... " >>$_INSTALL_LOG;
	echo " " >>$_INSTALL_LOG;
	if [ ! -f courier-imap-4.0.6.tar.bz2 ]; then

		wget http://jaist.dl.sourceforge.net/sourceforge/courier/courier-imap-4.0.6.tar.bz2 || return 1
	fi

	if [ -f courier-imap-4.0.6.tar.bz2 ]; then
		sh mysleep.sh &        
		EID=$!

		if [ ! -d courier-imap-4.0.6 ];then
			tar jxvf courier-imap-4.0.6.tar.bz2 >>$_INSTALL_LOG 2>&1 || return 1
		fi

		cd courier-imap-4.0.6
		#./configure --prefix=/usr/local/imap --with-redhat --disable-root-check --enable-unicode=utf-8,iso-8859-1,gb2312,gbk,gb18030 --with-trashquota --with-dirsync >>$_INSTALL_LOG 2>&1
		make install-strip >>$_INSTALL_LOG 2>&1
		make install >>$_INSTALL_LOG 2>&1
		make install-configure >>$_INSTALL_LOG 2>&1
		cp courier-imap.sysvinit /etc/rc.d/init.d/courier-imap >>$_INSTALL_LOG 2>&1
		chmod 755 /etc/rc.d/init.d/courier-imap >>$_INSTALL_LOG 2>&1
		cd ..
		cp -f courier_conf/main.cf /etc/postfix/main.cf
		cp -f courier_conf/virtual.mysql /etc/postfix/
		cp -f courier_conf/filter.mysql /etc/postfix/
		mysql <courier_conf/mail.sql
		sed -e "s/POP3DSTART=NO/POP3DSTART=YES/" -r -i.org /usr/local/imap/etc/pop3d
		sed -e "s/IMAPDSTART=NO/IMAPDSTART=YES/" -r -i.org /usr/local/imap/etc/imapd
		/etc/rc.d/init.d/courier-imap start
		mkdir -p /data/mail
		chown maildrop:maildrop /data/mail
		su -s/bin/bash maildrop
		cd /data/mail
		mkdir trueuser
		/usr/local/bin/maildirmake trueuser/Maildir
		mkdir -p cngnu.org/virtualuser
		/usr/local/bin/maildirmake cngnu.org/virtualuser/Maildir
		exit

		kill $EID >/dev/null 2>&1
	fi
	return 0
}

function getPostfixAdmin()
{
	echo "==> Start CourierImap install ... ";
	if [ ! -f postfixadmin-2.1.0.tgz ]; then


		wget http://high5.net/postfixadmin/download.php?file=postfixadmin-2.1.0.tgz || return 1

	fi

	if [ -f postfixadmin-2.1.0.tgz ]; then


		tar vxzf postfixadmin-2.1.0.tgz || return 1
		cd ..
	fi
	return 0
}

function getPostfix()
{
	echo "==> Start Postfix install ... ";
	userdel postfix
	groupdel postfix
	groupdel postdrop
	groupadd -g 400 postfix
	groupadd -g 401 postdrop
	useradd -g mail postfix
	useradd -u 400 -g 400 -c postfix -M -d/no/where -s/no/shell postfix
	if [ ! -f postfix-2.2.5.tar.gz ]; then

		wget ftp://postfix.linuxaid.com.cn/pub/postfix/official/postfix-2.2.5.tar.gz || return 1

	fi
	if [ -f postfix-2.2.5.tar.gz ]; then

		rm -rf postfix-2.2.5
		tar -xvzf postfix-2.2.5.tar.gz
		cd postfix-2.2.5
		make -f Makefile.init makefiles 'CCARGS=-DUSE_SASL_AUTH -DHAS_MYSQL -I/usr/local/include/mysql -I/usr/include/sasl' 'AUXLIBS=-L/usr/local/lib/mysql -L/usr/lib/sasl2 -lmysqlclient -lsasl2 -lz -lm'
		make install
		

		cd ../
		echo 'root: virtualuser@$_INSTALL_DOMAIN_NAME' >> /etc/postfix/aliases
		postalias /etc/postfix/aliases
		postmap /etc/postfix/virtual

		[ -f /etc/postfix/main.cf ] && mv /etc/postfix/main.cf /etc/postfix/main.cf.arzen.orig
		cp main.cf /etc/postfix/main.cf
		cp virtual.mysql /etc/postfix/virtual.mysql
		cp filter.mysql /etc/postfix/filter.mysql

		postfix start

	fi
	return 0

}

function getApacheInstall()
{
	echo " "
	echo -n $"==> Start apache installl ... " 
	echo " "

	echo " " >>$_INSTALL_LOG;
	echo -n $"==> Start apache install ... " >>$_INSTALL_LOG;
	echo " " >>$_INSTALL_LOG;

	if [ ! -f httpd-2.0.55.tar.gz ]; then

		wget http://mirror.worria.com/apache/httpd/httpd-2.0.55.tar.gz || return 1

	fi
	if [ -f httpd-2.0.55.tar.gz ]; then

		if [ ! -d httpd-2.0.55 ]; then
			tar -xvzf httpd-2.0.55.tar.gz >>$_INSTALL_LOG 2>&1
		fi

		cd httpd-2.0.55 >>$_INSTALL_LOG 2>&1
		./configure --enable-rewrite --enable-ssl --enable-mods-shared=all --enable-cgi >>$_INSTALL_LOG 2>&1
		make >>$_INSTALL_LOG 2>&1
		make install >>$_INSTALL_LOG 2>&1

		openssl genrsa -des3 -out ca.key 1024
		openssl req -new -x509 -days 3650 -key ca.key -out ca.crt
		chmod 400 ca.crt
		openssl x509 -noout -text -in ca.crt
		openssl genrsa -des3 -out server.key 1024
		chmod 400 server.key
		openssl rsa -noout -text -in server.key
		openssl req -new -key server.key -out server.csr
		openssl req -noout -text -in server.csr
		mkdir /usr/local/apache2/conf/ssl.crt
		cp server.csr /usr/local/apache2/conf/ssl.crt/server.crt
		mkdir /usr/local/apache2/conf/ssl.key
		cp server.key /usr/local/apache2/conf/ssl.key/server.key

		cd ..

	fi
	return 0
	
}

function uninstallApache()
{
	/usr/local/apache2/bin/apachectl -k stop >>$_INSTALL_LOG 2>&1
	rm -rf /usr/local/apache2
}

function getIMAPPlus()
{
	echo "==> Start apache install ... ";
	if [ ! -f imap.tar.Z ]; then

		wget ftp://ftp.cac.washington.edu/mail/imap.tar.Z || return 1

	fi
	if [ -f httpd-2.0.55.tar.gz ]; then
		rm -rf imap
		tar -xvzf imap.tar.Z 
		cd imap
		./configure --enable-rewrite=shared --enable-speling=shared
		make
		make install
		cd ..
	fi
	return 0
	
}

function getMysqlInstall()
{
	echo " "
	echo -n $"==> Start mysql install ... " 
	echo " "

	echo " " >>$_INSTALL_LOG;
	echo -n $"==> Start mysql install ... " >>$_INSTALL_LOG;
	echo " " >>$_INSTALL_LOG;

	if [ ! -f mysql-4.0.26.tar.gz ]; then

		wget http://dev.mysql.com/get/Downloads/MySQL-4.0/mysql-4.0.26.tar.gz/from/http://mysql.isu.edu.tw/ || return 1

	fi
	if [ -f mysql-4.0.26.tar.gz ]; then

		sh mysleep.sh &        
		EID=$!

		groupadd mysql >>$_INSTALL_LOG 2>&1
		useradd -g mysql mysql >>$_INSTALL_LOG 2>&1
		
		if [ ! -d mysql-4.0.26 ]; then
			tar -xvzf mysql-4.0.26.tar.gz >>$_INSTALL_LOG 2>&1
		fi

		cd mysql-4.0.26 >>$_INSTALL_LOG 2>&1
		./configure >>$_INSTALL_LOG 2>&1
		make >>$_INSTALL_LOG 2>&1
		make install >>$_INSTALL_LOG 2>&1
		mysql_install_db --user=mysql >>$_INSTALL_LOG 2>&1
		ln -s /usr/local/var/mysql /usr/local/libexec/mysql >>$_INSTALL_LOG 2>&1
		cp /usr/local/lib/mysql/*.* /usr/lib >>$_INSTALL_LOG 2>&1
		mysqld_safe --user=mysql & >>$_INSTALL_LOG 2>&1
		cd ..

		kill $EID >/dev/null 2>&1

	fi
	return 0
}

function uninstallMysql()
{
	cd mysql-4.0.26
	uninstallIsure
}

function getPHPInstall()
{
	echo "==> Start php install ... ";
	if [ ! -f php-4.4.1.tar.gz ]; then

		wget http://cn.php.net/get/php-4.4.1.tar.gz/from/this/mirror || return 1
	fi
	if [ -f php-4.4.1.tar.gz ]; then
		rm -rf php-4.4.1
		tar -xvzf php-4.4.1.tar.gz
		cd php-4.4.1
		./configure --with-apxs2=/usr/local/apache2/bin/apxs --with-zlib --with-mysql --enable-so --with-gettext  --with-gd --with-dom=/usr/local/lib --with-imap --with-ldap --with-openssl=/usr/local/ssl --with-iconv --enable-mbstring --with-mime-magic --with-dom-xslt --with-mcrypt 
		make
		make install
		cd ..
		cp php.ini /usr/local/lib
	fi
	return 0
}

function getLibxml2()
{
	echo " "
	echo -n $"==> Start Libxml2 install ... " 
	echo " "

	echo " " >>$_INSTALL_LOG;
	echo -n $"==> Start Libxml2 install ... " >>$_INSTALL_LOG;
	echo " " >>$_INSTALL_LOG;

	if [ ! -f libxml2-2.6.22.tar.gz ]; then

		wget http://xmlsoft.org/sources/libxml2-2.6.22.tar.gz || return 1
	fi
	if [ -f libxml2-2.6.22.tar.gz ]; then

		sh mysleep.sh &        
		EID=$!

		if [ ! -d libxml2-2.6.22 ]; then
			tar -xvzf libxml2-2.6.22.tar.gz >>$_INSTALL_LOG 2>&1
		fi

		cd libxml2-2.6.22 >>$_INSTALL_LOG 2>&1
		./configure >>$_INSTALL_LOG 2>&1
		make >>$_INSTALL_LOG 2>&1
		make install >>$_INSTALL_LOG 2>&1
		cd ..

		kill $EID >/dev/null 2>&1

	fi
	return 0
}

function getPHP5Install()
{
	echo " "
	echo -n $"==> Start php install ... " 
	echo " "

	echo " " >>$_INSTALL_LOG;
	echo -n $"==> Start php install ... " >>$_INSTALL_LOG;
	echo " " >>$_INSTALL_LOG;

	if [ ! -f php-5.1.0RC6.tar.gz ]; then

		wget http://downloads.php.net/ilia/php-5.1.0RC6.tar.gz || return 1
	fi
	if [ -f php-5.1.0RC6.tar.gz ]; then

		sh mysleep.sh &        
		EID=$!
		
		if [ ! -d php-5.1.0RC6 ]; then
			tar -xvzf php-5.1.0RC6.tar.gz >>$_INSTALL_LOG 2>&1
		fi

		cd php-5.1.0RC6 >>$_INSTALL_LOG 2>&1
		./configure --with-apxs2=/usr/local/apache2/bin/apxs --with-mysql --enable-so --with-gettext --with-gd --enable-ftp  --with-jpeg-dir  --with-png-dir  --with-zlib --with-libxml-dir >>$_INSTALL_LOG 2>&1
		make >>$_INSTALL_LOG 2>&1
		make install >>$_INSTALL_LOG 2>&1
		cd .. 
		cp php.ini /usr/local/lib

		kill $EID >/dev/null 2>&1

	fi
	return 0
}

function getPureFTPD()
{
	echo " " >>$_INSTALL_LOG;
	echo -n $"==> Start PureFTPD install ... " >>$_INSTALL_LOG;
	echo " " >>$_INSTALL_LOG;
	if [ ! -f pure-ftpd-1.0.20.tar.gz ]; then


		wget ftp://ftp.pureftpd.org/pub/pure-ftpd/releases/pure-ftpd-1.0.20.tar.gz || return 1

	fi

	if [ -f pure-ftpd-1.0.20.tar.gz ]; then
		sh mysleep.sh &        
		EID=$!

		if [ ! -f pure-ftpd-1.0.20 ];then
			tar zxvf pure-ftpd-1.0.20.tar.gz >>$_INSTALL_LOG 2>&1 || return 1
		fi

		cd pure-ftpd-1.0.20
		./configure --prefix=/usr/local/pureftpd --with-mysql=/usr/local/mysql --with-paranoidmsg --with-shadow --with-welcomemsg --with-uploadscript --with-quotas --with-cookie --with-pam --with-virtualhosts --with-virtualroot --with-diraliases --with-sysquotas --with-ratios --with-ftpwho --with-throttling --with-language=simplified-chinese >>$_INSTALL_LOG 2>&1
		make install >>$_INSTALL_LOG 2>&1
		cd ..

		kill $EID >/dev/null 2>&1
	fi
	return 0
}

function getJabberd2()
{
	echo " " >>$_INSTALL_LOG;
	echo -n $"==> Start Jabberd 2 install ... " >>$_INSTALL_LOG;
	echo " " >>$_INSTALL_LOG;
	if [ ! -f jabberd-2.0s10.tar.gz ]; then


		wget http://ftp4.de.freebsd.org/pub/FreeBSD/distfiles/jabber/jabberd-2.0s10.tar.gz || return 1

	fi

	if [ -f jabberd-2.0s10.tar.gz ]; then
		sh mysleep.sh &        
		EID=$!

		if [ ! -f jabberd-2.0s10 ];then
			tar zxvf jabberd-2.0s10.tar.gz >>$_INSTALL_LOG 2>&1 || return 1
		fi

		cd jabberd-2.0s10
		./configure --prefix=/usr/local/jabberd2 >>$_INSTALL_LOG 2>&1
		make >>$_INSTALL_LOG 2>&1
		make check >>$_INSTALL_LOG 2>&1
		make install >>$_INSTALL_LOG 2>&1
		cd ..

		kill $EID >/dev/null 2>&1
	fi
	return 0
}

function getPowerDNS()
{
	echo " " >>$_INSTALL_LOG;
	echo -n $"==> Start PowerDNS install ... " >>$_INSTALL_LOG;
	echo " " >>$_INSTALL_LOG;
	if [ ! -f pdns-2.9.19.tar.gz ]; then


		wget http://downloads.powerdns.com/releases/pdns-2.9.19.tar.gz || return 1

	fi

	if [ -f pdns-2.9.19.tar.gz ]; then
		sh mysleep.sh &        
		EID=$!

		if [ ! -d pdns-2.9.19 ];then
			tar zxvf pdns-2.9.19.tar.gz >>$_INSTALL_LOG 2>&1 || return 1
		fi

		cd pdns-2.9.19
		./configure --prefix=/usr/local/pdns --with-modules="gmysql">>$_INSTALL_LOG 2>&1
		make >>$_INSTALL_LOG 2>&1
		make install >>$_INSTALL_LOG 2>&1
		cd ..

		kill $EID >/dev/null 2>&1
	fi
	return 0
}

function getLibidn()
{
	echo " " >>$_INSTALL_LOG;
	echo -n $"==> Start Libidn install ... " >>$_INSTALL_LOG;
	echo " " >>$_INSTALL_LOG;
	if [ ! -f libidn-0.5.20.tar.gz ]; then


		wget http://josefsson.org/libidn/releases/libidn-0.5.20.tar.gz || return 1

	fi

	if [ -f libidn-0.5.20.tar.gz ]; then
		sh mysleep.sh &        
		EID=$!

		if [ ! -d libidn-0.5.20 ];then
			tar zxvf libidn-0.5.20.tar.gz >>$_INSTALL_LOG 2>&1 || return 1
		fi

		cd libidn-0.5.20
		./configure>>$_INSTALL_LOG 2>&1
		make >>$_INSTALL_LOG 2>&1
		make install >>$_INSTALL_LOG 2>&1
		cd ..

		kill $EID >/dev/null 2>&1
	fi
	return 0
}

function getBoost()
{
	echo " " >>$_INSTALL_LOG;
	echo -n $"==> Start Boost install ... " >>$_INSTALL_LOG;
	echo " " >>$_INSTALL_LOG;
	if [ ! -f boost_1_33_0.tar.gz ]; then


		wget http://ovh.dl.sourceforge.net/sourceforge/boost/boost_1_33_0.tar.gz || return 1

	fi

	if [ -f boost_1_33_0.tar.gz ]; then
		sh mysleep.sh &        
		EID=$!

		if [ ! -d boost_1_33_0 ];then
			tar zxvf boost_1_33_0.tar.gz >>$_INSTALL_LOG 2>&1 || return 1
		fi

		cd boost_1_33_0
		./configure>>$_INSTALL_LOG 2>&1
		make >>$_INSTALL_LOG 2>&1
		make install >>$_INSTALL_LOG 2>&1
		cd ..

		kill $EID >/dev/null 2>&1
	fi
	return 0
}

function setJail()
{
	echo " "
	echo -n $"==> Start Change root install ... " 
	echo " "

	echo " " >>$_INSTALL_LOG;
	echo -n $"==> Start Jail Change root install ... " >>$_INSTALL_LOG;
	echo " " >>$_INSTALL_LOG;
	if [ ! -f jail_1.9a.tar.tar ]; then


		wget http://freshmeat.net/redir/jail_cp/14192/url_tgz/projecthelper.php || return 1

	fi

	if [ -f jail_1.9a.tar.tar ]; then
		sh mysleep.sh &        
		EID=$!

		if [ ! -d jail ];then
			tar zxvf jail_1.9a.tar.tar >>$_INSTALL_LOG 2>&1 || return 1
		fi

		cd jail/src
		make >>$_INSTALL_LOG 2>&1
		make install >>$_INSTALL_LOG 2>&1
		cd ../../
		/usr/local/bin/mkjailenv /server_chroot/webroot_chroot
		/usr/local/bin/addjailsw /server_chroot/webroot_chroot
		/usr/local/bin/addjailsw /server_chroot/webroot_chroot -P bash

		/usr/local/bin/mkjailenv /server_chroot/dbaroot_chroot
		/usr/local/bin/addjailsw /server_chroot/dbaroot_chroot
		/usr/local/bin/addjailsw /server_chroot/dbaroot_chroot -P bash

		/usr/local/bin/mkjailenv /server_chroot/sshroot_chroot
		/usr/local/bin/addjailsw /server_chroot/sshroot_chroot
		/usr/local/bin/addjailsw /server_chroot/sshroot_chroot -P bash
		/usr/local/bin/addjailsw /server_chroot/sshroot_chroot -P ssh
		/usr/local/bin/addjailsw /server_chroot/sshroot_chroot -P /usr/bin/sshd

		userdel webroot
		userdel dbaroot
		userdel sshroot
		groupdel cust

		groupadd -g 8888 cust
		useradd -g 8888 webroot
		useradd -g 8888 sshroot
		useradd -g 8888 dbaroot

		sed -e "s/8888::\/home\/webroot:\/bin\/bash/8888::\/server_chroot\/webroot_chroot:\/usr\/local\/bin\/jail/" -e "s/8888::\/home\/dbaroot:\/bin\/bash/8888::\/server_chroot\/dbaroot_chroot:\/usr\/local\/bin\/jail/" -e "s/8888::\/home\/sshroot:\/bin\/bash/8888::\/server_chroot\/sshroot_chroot:\/usr\/local\/bin\/jail/" -r -i.org /etc/passwd

		/usr/local/bin/addjailuser /server_chroot/webroot_chroot /home/webroot /bin/bash webroot
		/usr/local/bin/addjailuser /server_chroot/webroot_chroot /home/webroot /bin/bash postfix
		/usr/local/bin/addjailuser /server_chroot/webroot_chroot /home/webroot /bin/bash postdrop
		
		/usr/local/bin/addjailuser /server_chroot/dbaroot_chroot /home/dbaroot /bin/bash dbaroot
		/usr/local/bin/addjailuser /server_chroot/sshroot_chroot /home/sshroot /bin/bash sshroot


		kill $EID >/dev/null 2>&1
	fi
	return 0
}

function chrootMysql()
{
	/usr/local/bin/addjailuser /server_chroot/dbaroot_chroot /home/dbaroot /bin/bash mysql
	/usr/local/bin/addjailsw /server_chroot/dbaroot_chroot -P mysql
	/usr/local/bin/addjailsw /server_chroot/dbaroot_chroot -P mysql_install_db
	/usr/local/bin/addjailsw /server_chroot/dbaroot_chroot -P hostname
	/usr/local/bin/addjailsw /server_chroot/dbaroot_chroot -P my_print_defaults
	/usr/local/bin/addjailsw /server_chroot/dbaroot_chroot -P resolveip
	/usr/local/bin/addjailsw /server_chroot/dbaroot_chroot -P date
	/usr/local/bin/addjailsw /server_chroot/dbaroot_chroot -P tee
	cp -p /usr/local/bin/mysql* /server_chroot/dbaroot_chroot/usr/local/bin
	mkdir /server_chroot/dbaroot_chroot/usr/local/libexec/
	cp -p /usr/local/libexec/mysqld /server_chroot/dbaroot_chroot/usr/local/libexec/
	mkdir /server_chroot/dbaroot_chroot/usr/local/share/mysql/english/
	cp -p /usr/local/share/mysql/english/errmsg.sys /server_chroot/dbaroot_chroot/usr/local/share/mysql/english/
	cp -p /etc/hosts /server_chroot/dbaroot_chroot/etc/
	cp -p /etc/host.conf /server_chroot/dbaroot_chroot/etc/
	cp -p /etc/resolv.conf /server_chroot/dbaroot_chroot/etc/
	chown mysql mysql -cR /server_chroot/dbaroot_chroot/usr/local/var
	
	rm -rf /server_chroot/dbaroot_chroot/usr/local/var
	cp -R /usr/local/var /server_chroot/dbaroot_chroot/usr/local/
	chown -R mysql:mysql /server_chroot/dbaroot_chroot/usr/local/var
	chmod 777 -cR /server_chroot/dbaroot_chroot/usr/local/var

	chroot /server_chroot/dbaroot_chroot /usr/local/bin/mysql_install_db
	chroot /server_chroot/dbaroot_chroot /usr/local/bin/mysqld_safe &
	cat /server_chroot/dbaroot_chroot/usr/local/server_chroot/0.err
	GRANT USAGE ON * . * TO 'root'@'%' IDENTIFIED BY 'test'
	GRANT ALL PRIVILEGES ON `bbs` . * TO 'arzen'@'%' WITH GRANT OPTION
	GRANT ALL PRIVILEGES ON * . * TO 'dba'@'%' IDENTIFIED BY 'dba' WITH GRANT OPTION ;
}

function chrootApachePhp()
{
	cp -Rf /usr/local/apache2 /server_chroot/webroot_chroot/usr/local/apache2
	/usr/local/bin/addjailsw /server_chroot/webroot_chroot -P httpd
	/usr/local/bin/addjailsw /server_chroot/webroot_chroot -P mysql
	/usr/local/bin/addjailsw /server_chroot/webroot_chroot -P postfix
	/usr/local/bin/addjailsw /server_chroot/webroot_chroot -P postlog
	/usr/local/bin/addjailsw /server_chroot/webroot_chroot -P postconf

	/usr/local/bin/addjailsw /server_chroot/webroot_chroot -P postqueue
	/usr/local/bin/addjailsw /server_chroot/webroot_chroot -P uname
	/usr/local/bin/addjailsw /server_chroot/webroot_chroot -P cmp

	/usr/local/bin/addjailsw /server_chroot/webroot_chroot -P find
	/usr/local/bin/addjailsw /server_chroot/webroot_chroot -P egrep
	/usr/local/bin/addjailsw /server_chroot/webroot_chroot -P php
	cp /usr/sbin/sendmail /server_chroot/webroot_chroot/usr/sbin/
	cp /usr/sbin/postsuper /server_chroot/webroot_chroot/usr/sbin/
	cp /usr/local/lib/lib* /server_chroot/webroot_chroot/usr/local/lib/
	mkdir /server_chroot/webroot_chroot/usr/libexec
	cp -Rp --reply=yes /usr/libexec/postfix /server_chroot/webroot_chroot/usr/libexec

	cp /usr/lib/libmysql* /server_chroot/webroot_chroot/usr/lib/
	cp /usr/lib/libsasl* /server_chroot/webroot_chroot/usr/lib/
	cp -R /etc/postfix /server_chroot/webroot_chroot/etc/postfix
	mkdir /server_chroot/webroot_chroot/var/spool/
	cp -Rp --reply=yes /var/spool /server_chroot/webroot_chroot/var/
	chmod 777 -cR /server_chroot/webroot_chroot/var/
	mkdir /server_chroot/webroot_chroot/var/spool/maildrop
	mkdir /server_chroot/webroot_chroot/var/log
	/usr/local/bin/addjailsw /server_chroot/webroot_chroot -P postdrop

	cp -p --reply=yes /usr/sbin/postqueue /server_chroot/webroot_chroot/usr/sbin/postqueue
	cp -p --reply=yes /usr/sbin/postdrop /server_chroot/webroot_chroot/usr/sbin/postdrop

	vi /server_chroot/webroot_chroot/usr/local/lib/php.ini 
	
	chroot /server_chroot/webroot_chroot /usr/local/apache2/bin/apachectl start
	chroot /server_chroot/webroot_chroot /usr/sbin/postfix
}

function chrootSSHD()
{
	/usr/local/bin/addjailsw /server_chroot/sshroot_chroot -P ssh-keygen
	/usr/local/bin/addjailsw /server_chroot/sshroot_chroot -P initlog
	/usr/local/bin/addjailsw /server_chroot/sshroot_chroot -P consoletype
	/usr/local/bin/addjailsw /server_chroot/sshroot_chroot -P pidof
	cp -R /etc/ssh /server_chroot/sshroot_chroot/etc/
	mkdir -p /server_chroot/sshroot_chroot/var/run
	mkdir -p /server_chroot/sshroot_chroot/var/lock/subsys/
	mkdir /server_chroot/sshroot_chroot/etc/init.d/
	cp -p /etc/init.d/sshd /server_chroot/sshroot_chroot/etc/init.d/
	mkdir /server_chroot/sshroot_chroot/etc/rc.d/
	mkdir /server_chroot/sshroot_chroot/etc/rc.d/init.d
	cp /etc/rc.d/init.d/functions /server_chroot/sshroot_chroot/etc/rc.d/init.d/functions
	chroot /server_chroot/sshroot_chroot /etc/init.d/sshd start
}

function setSecurity()
{
	echo " "
	echo -n $"==> Start Security Setting ... " 
	echo " "

	echo " " >>$_INSTALL_LOG;
	echo -n $"==> Start Security Setting ... " >>$_INSTALL_LOG;
	echo " " >>$_INSTALL_LOG;
	
	sh mysleep.sh &        
	EID=$!

	sed -e "s/ca::ctrlaltdel:/#ca::ctrlaltdel:/" -r -i.org /etc/inittab >>$_INSTALL_LOG 2>&1

	echo "TMOUT=3600" >> /etc/profile
	
	[ -f /etc/securetty ] && mv /etc/securetty /etc/securetty.orig >>$_INSTALL_LOG 2>&1
	echo tty1 > /etc/securetty
	
	echo 1 > /proc/sys/net/ipv4/icmp_echo_ignore_all

	userdel adm 
	userdel lp 
	userdel sync 
	userdel shutdown 
	userdel halt 

	userdel news 
	userdel uucp 
	userdel operator 
	userdel games 

	userdel gopher 
	userdel ftp 

	groupdel adm 
	groupdel lp 

#	chattr +i /etc/passwd >>$_INSTALL_LOG 2>&1
#	chattr +i /etc/shadow >>$_INSTALL_LOG 2>&1
#	chattr +i /etc/group >>$_INSTALL_LOG 2>&1
#	chattr +i /etc/gshadow >>$_INSTALL_LOG 2>&1

	sed -e "s/auth       sufficient   \/lib\/security\/\$ISA\/pam_rootok.so/auth       sufficient   \/lib\/security\/\$ISA\/pam_rootok.so debug /" -r -i.org /etc/pam.d/su >>$_INSTALL_LOG 2>&1
	echo "auth       required     /lib/security/$ISA/pam_wheel.so group=pwroot " >>/etc/pam.d/su
	
	userdel pwroot
	groupdel pwroot
	groupadd pwroot
	useradd -g pwroot -p passwd pwroot

	userdel arzen
	groupdel arzen
	useradd -p passwd arzen

	cp conf/ssh_banner.txt /etc/ssh
	echo "Banner /etc/ssh/ssh_banner.txt " >>/etc/ssh/sshd_config

	mv /etc/issue /etc/issue.org
	mv /etc/issue.net /etc/issue.net.org
	touch /etc/issue
	touch /etc/issue.net

	# ·ÀÖ¹IPÆÛÆ­ #
	echo "order bind, hosts ">>/etc/host.conf
	echo "multi off ">>/etc/host.conf
	echo "nospoof on ">>/etc/host.conf

	# ·ÀÖ¹DoS¹¥»÷ #
	echo "* hard core 0 ">>/etc/security/limits.conf
	echo "* hard rss 5000 ">>/etc/security/limits.conf
	echo "* hard nproc 20 ">>/etc/security/limits.conf
	echo "session required /lib/security/pam_limits.so ">>/etc/pam.d/login

	cd $_SOURCE_DIR >>$_INSTALL_LOG 2>&1
	cp conf/rc.firewall /etc/init.d/ >>$_INSTALL_LOG 2>&1
	chmod +x /etc/init.d/rc.firewall >>$_INSTALL_LOG 2>&1
	/etc/init.d/rc.firewall start >>$_INSTALL_LOG 2>&1

	echo "/etc/init.d/rc.firewall start" >>/etc/rc.d/rc.local
	
	kill $EID >/dev/null 2>&1

}

function uninstallPHP5()
{
	cd php-4.4.1
	uninstallIsure
	cd ..
}

function callSystemSleep()
{
	echo |awk '{printf "||",$1}'
	while sleep 1
	do
	echo "#" |awk '{printf "%s",$1}'
	done
}

function uninstallIsure()
{
	make uninstall
	make clean
	make distclean
}

function thankyouMsg()
{
	echo " "
	echo " "
	echo "+---------------------------------------------------------+";
	echo "|                 Thank you                               |";
	echo "|         Copyright (C) 2004 by ÃÏÔ¶òû arzen              |";
	echo "|         E mail:arzen1013@163.com QQ:3440895             |";
	echo "+---------------------------------------------------------+";
	echo " "
}

#--------------- Install Part --------------------------#
if [ "$_TODO_METHOD" = "INSTALL"  ]; then

	echo "Install Sart Time:$_START_DATE ">>$_INSTALL_LOG 2>&1
	echo " ">>$_INSTALL_LOG 2>&1
	echo "Install Source Dir:$_SOURCE_DIR ">>$_INSTALL_LOG 2>&1
	echo " ">>$_INSTALL_LOG 2>&1
	checkSystem

	if [ "$_INSTALL_APACHE" = "y" ]; then

		getApacheInstall
	fi

	if [ "$_INSTALL_MYSQL" = "y" ]; then

		getMysqlInstall
	fi

	if [ "$_INSTALL_LIBXML2" = "y" ]; then

		getLibxml2
	fi

	if [ "$_INSTALL_PHP" = "y" ]; then

		getPHPInstall
	fi

	if [ "$_INSTALL_PHP5" = "y" ]; then

		getPHP5Install
	fi

	if [ "$_INSTALL_PAM_MYSQL" = "y" ]; then

		getPamMysql50
	fi

	if [ "$_INSTALL_POSTFIX" = "y" ]; then

		removeOldSendmail
		createMysqlDB
		configMysqlPAM
		getPostfix
	fi

	if [ "$_INSTALL_CYRUSIMAP" = "y" ]; then

		getCyrusIMAP
	fi
	
	fi

	if [ "$_INSTALL_PCRE" = "y" ]; then

		getPCRE
	fi

	if [ "$_INSTALL_COURIERAUTHLIB" = "y" ]; then

		getCourierAuthlib
	fi

	if [ "$_INSTALL_COURIERIMAP" = "y" ]; then

		getCourierImap
	fi

	if [ "$_INSTALL_LIBIDN" = "y" ]; then

		getLibidn
	fi

	if [ "$_INSTALL_BOOST" = "y" ]; then

		getBoost
	fi

	if [ "$_INSTALL_MAILDROP" = "y" ]; then

		getMailDrop163
	fi

	if [ "$_INSTALL_PUREFTPD" = "y" ]; then

		getPureFTPD
	fi

	if [ "$_INSTALL_JABBERD2" = "y" ]; then

		getJabberd2
	fi

	if [ "$_INSTALL_POWERDNS" = "y" ]; then

		getPowerDNS
	fi

	if [ "$_SET_SECURITY" = "y" ]; then

		setSecurity
	fi

	thankyouMsg

fi

#--------------- Uninstall Part --------------------------#

if [ "$_TODO_METHOD" = "UNINSTALL"  ]; then

	echo "UnInstall Sart Time:$_START_DATE ">>$_UNINSTALL_LOG 2>&1
	echo " ">>$_INSTALL_LOG 2>&1
	echo "UnInstall Source Dir:$_SOURCE_DIR ">>$_UNINSTALL_LOG 2>&1
	echo " ">>$_INSTALL_LOG 2>&1

	if [ "$_INSTALL_APACHE" = "y" ]; then

		uninstallApache
	fi

	if [ "$_INSTALL_MYSQL" = "y" ]; then

		uninstallMysql
	fi
	thankyouMsg
	
fi

