#!/bin/sh
# $Id: setup.sh,v 1.3 2005/12/03 01:17:56 arzen Exp $
PATH=/bin:/sbin:/usr/bin:/usr/sbin:/usr/local/bin:/usr/local/sbin

# Linux Server Setup Script v2.0
# 2005-11-26 
# Copyright (C) 2004 by (John.meng)��Զ��
# E-mail:arzen1013@yahoo.com.cn QQ:3440895
# Warning !! This script only for Red hat Linux 9.0,unknow use other system.

_INSTALL_APACHE="n" 
_INSTALL_MYSQL="n" 
_INSTALL_PHP="n" 
_INSTALL_POSTFIX="n" 
_INSTALL_PAM_MYSQL="n" 
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
_SET_SECURITY="y"

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
echo "|         compile by ��Զ��                               |";
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
	echo "==> Star check your system ... ";

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

	echo "Checking...for libxml2"
	rpm -q libxml2
	if [ "$?" = 1 ]; then
	echo 'Sorry,Your system not "libxml2" program!'
	exit 0
	fi
}


function removeOldSendmail()
{
	echo "==> Star remove old sendmail ... ";
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
	echo "==> Star CyrusIMAP install ... ";
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
	echo "==> Star PCRE install ... " >>$_INSTALL_LOG 2>&1;
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
	echo -n $"==> Star MailDrop install ... "
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
	echo -n $"==> Star MailDrop163 install ... "
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
	echo "==> Star CourierAuthlib install ... " >>$_INSTALL_LOG 2>&1
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
	echo "==> Star CourierImap install ... " >>$_INSTALL_LOG;
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
	echo "==> Star CourierImap install ... ";
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
	echo "==> Star Postfix install ... ";
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
	echo "==> Star apache install ... ";
	if [ ! -f httpd-2.0.55.tar.gz ]; then

		wget http://mirror.worria.com/apache/httpd/httpd-2.0.55.tar.gz || return 1

	fi
	if [ -f httpd-2.0.55.tar.gz ]; then
		rm -rf httpd-2.0.55
		tar -xvzf httpd-2.0.55.tar.gz
		cd httpd-2.0.55
		./configure --enable-rewrite=shared --enable-speling=shared
		make
		make install
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
	echo "==> Star apache install ... ";
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
	echo "==> Star mysql install ... ";
	if [ ! -f mysql-4.0.26.tar.gz ]; then

		wget http://dev.mysql.com/get/Downloads/MySQL-4.0/mysql-4.0.26.tar.gz/from/http://mysql.isu.edu.tw/ || return 1

	fi
	if [ -f mysql-4.0.26.tar.gz ]; then
		groupadd mysql
		useradd -g mysql mysql
		tar -xvzf mysql-4.0.26.tar.gz
		cd mysql-4.0.26
		./configure
		make
		make install
		mysql_install_db --user=mysql
		ln -s /usr/local/var/mysql /usr/local/libexec/mysql
		cp /usr/local/lib/mysql/*.* /usr/lib
		mysqld_safe --user=mysql &
		cd ..
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
	echo "==> Star php install ... ";
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
	echo "==> Star php install ... ";
	if [ ! -f libxml2-2.6.22.tar.gz ]; then

		wget http://xmlsoft.org/sources/libxml2-2.6.22.tar.gz || return 1
	fi
	if [ -f libxml2-2.6.22.tar.gz ]; then
		rm -rf libxml2-2.6.22
		tar -xvzf libxml2-2.6.22.tar.gz
		cd libxml2-2.6.22
		./configure
		make
		make install
		cd ..
	fi
	return 0
}

function getPHP5Install()
{
	echo "==> Star php install ... ";
	if [ ! -f php-5.1.0RC6.tar.gz ]; then

		wget http://downloads.php.net/ilia/php-5.1.0RC6.tar.gz || return 1
	fi
	if [ -f php-5.1.0RC6.tar.gz ]; then
		rm -rf php-5.1.0RC6
		tar -xvzf php-5.1.0RC6.tar.gz
		cd php-5.1.0RC6
		./configure --with-apxs2=/usr/local/apache2/bin/apxs --with-mysql --enable-so --with-gettext --with-gd --enable-ftp  --with-jpeg-dir  --with-png-dir  --with-zlib --with-libxml-dir
		make
		make install
		cd ..
		cp php.ini /usr/local/lib
	fi
	return 0
}

function getPureFTPD()
{
	echo " " >>$_INSTALL_LOG;
	echo -n $"==> Star PureFTPD install ... " >>$_INSTALL_LOG;
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
	echo -n $"==> Star Jabberd 2 install ... " >>$_INSTALL_LOG;
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
	echo -n $"==> Star PowerDNS install ... " >>$_INSTALL_LOG;
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
	echo -n $"==> Star Libidn install ... " >>$_INSTALL_LOG;
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
	echo -n $"==> Star Boost install ... " >>$_INSTALL_LOG;
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

function setSecurity()
{
	echo " "
	echo -n $"==> Star Security Setting ... " 
	echo " "

	echo " " >>$_INSTALL_LOG;
	echo -n $"==> Star Security Setting ... " >>$_INSTALL_LOG;
	echo " " >>$_INSTALL_LOG;

	sed -e "s/ca::ctrlaltdel:/#ca::ctrlaltdel:/" -r -i.org /etc/inittab >>$_INSTALL_LOG 2>&1

	echo "TMOUT=3600" >> /etc/profile >>$_INSTALL_LOG 2>&1
	
	[ -f /etc/securetty ] && mv /etc/securetty /etc/securetty.orig >>$_INSTALL_LOG 2>&1
	echo "tty1" > /etc/securetty >>$_INSTALL_LOG 2>&1
	
	echo 1 > /proc/sys/net/ipv4/icmp_echo_ignore_all >>$_INSTALL_LOG 2>&1

	userdel adm >>$_INSTALL_LOG 2>&1
	userdel lp >>$_INSTALL_LOG 2>&1
	userdel sync >>$_INSTALL_LOG 2>&1
	userdel shutdown >>$_INSTALL_LOG 2>&1
	userdel halt >>$_INSTALL_LOG 2>&1

	userdel news >>$_INSTALL_LOG 2>&1
	userdel uucp >>$_INSTALL_LOG 2>&1
	userdel operator >>$_INSTALL_LOG 2>&1
	userdel games >>$_INSTALL_LOG 2>&1

	userdel gopher >>$_INSTALL_LOG 2>&1
	userdel ftp >>$_INSTALL_LOG 2>&1

	groupdel adm >>$_INSTALL_LOG 2>&1
	groupdel lp >>$_INSTALL_LOG 2>&1

	chattr +i /etc/passwd >>$_INSTALL_LOG 2>&1
	chattr +i /etc/shadow >>$_INSTALL_LOG 2>&1
	chattr +i /etc/group >>$_INSTALL_LOG 2>&1
	chattr +i /etc/gshadow >>$_INSTALL_LOG 2>&1

	cd $_SOURCE_DIR >>$_INSTALL_LOG 2>&1
	cp conf/rc.firewall /etc/init.d/ >>$_INSTALL_LOG 2>&1
	chmod +x /etc/init.d/rc.firewall >>$_INSTALL_LOG 2>&1
	chkconfig --level 0123456 rc.firewall on >>$_INSTALL_LOG 2>&1
	/etc/init.d/rc.firewall start >>$_INSTALL_LOG 2>&1
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
	echo "|         Copyright (C) 2004 by ��Զ�� arzen              |";
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

	if [ "$_SET_SECURITY" = "y" ]; then

		setSecurity
	fi

	if [ "$_INSTALL_APACHE" = "y" ]; then

		getApacheInstall
	fi

	if [ "$_INSTALL_MYSQL" = "y" ]; then

		getMysqlInstall
	fi

	if [ "$_INSTALL_PHP" = "y" ]; then

		getPHPInstall
	fi

	if [ "$_INSTALL_PAM_MYSQL" = "y" ]; then

		getPamMysql
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