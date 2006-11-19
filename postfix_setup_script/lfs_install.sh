#!/bin/sh
# $Id: lfs_install.sh,v 1.1 2006/11/19 23:51:20 arzen Exp $
PATH=/bin:/sbin:/usr/bin:/usr/sbin:/usr/local/bin:/usr/local/sbin

_TODO_METHOD="INSTALL" 
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

function doPreparations()
{
echo $LFS
export LFS=/mnt/lfs

mkdir -pv $LFS
mount /dev/hda1 $LFS
swapon /dev/hda5
ln -sv $LFS/tools /

groupadd lfs
useradd -s /bin/bash -g lfs -m -k /dev/null lfs
passwd lfs
chown -v lfs $LFS/tools
chown -v lfs $LFS/sources
su - lfs

cat > ~/.bash_profile << "EOF"
exec env -i HOME=$HOME TERM=$TERM PS1='\u:\w\$ ' /bin/bash
EOF

cat > ~/.bashrc << "EOF"
set +h
umask 022
LFS=/mnt/lfs
LC_ALL=POSIX
PATH=/tools/bin:/bin:/usr/bin
export LFS LC_ALL PATH
EOF

source ~/.bash_profile
}

function GCCPass2()
{
	cd gcc-build
	../gcc-4.0.3/configure --prefix=/tools \
	    --with-local-prefix=/tools --enable-clocale=gnu \
	    --enable-shared --enable-threads=posix \
	    --enable-__cxa_atexit --enable-languages=c,c++ \
	    --disable-libstdcxx-pch
	make
	make -k check
	make install
}
function BinutilsPass2()
{
	mkdir -v binutils-build
	cd binutils-build
	../binutils-2.16.1/configure --prefix=/tools --disable-nls --with-lib-path=/tools/lib
	make
	make check
	make install
	make -C ld clean
	make -C ld LIB_PATH=/usr/lib:/lib
	cp -v ld/ld-new /tools/bin
}

#doPreparations
#GCCPass2
BinutilsPass2
