#!/bin/bash

# Script for help to compress a folder using distints methods

function use () {
    echo -e "\n\t[USE] USERNAME Filename CompresionType Folders"
    echo -e "\t\t CompresionType:"
    echo -e "\t\t  + tar.gz|gz  : Filename.tar.gz (default)"
    echo -e "\t\t  + tar.bz2|bz2: Filename.tar.bz2"
    echo -e "\t\t  + zip        : Filename.zip"
    echo -e "\t\t  + rar        : Filename.rar\n"
    exit 0
}

if [ $# -lt 3 -o "$1" == "-h" -o "$1" == "--help" ] ; then
    use
fi

# PARAMS
USERN="$1"
VERIF_USERN=`grep "^$USERN:" /etc/passwd`
if [ -z "$VERIF_USERN" ] ; then
    use
fi
FILEN="$2"
COMPTYPE=`echo "$3" | tr "[[:upper:]]" "[[:lower:]]"`

if [ -n "$4" ] ; then
    shift
    shift
    shift
    FOLDERS="$@"
else
    use
fi

# COMPRESION TYPE
case "$COMPTYPE" in
	"tar.bz2"|"bz2")
	    FILEEXT="tar.bz2"
	    COMMAND="sudo tar -cjf"
	    CHANGEOWN="true"
	    ;;
    "zip")
	    FILEEXT="zip"
	    COMMAND="zip -r -9"
	    CHANGEOWN="false"
	    ;;
    "rar")
	    FILEEXT="rar"
	    COMMAND="rar a -r -m5"
	    CHANGEOWN="false"
	    ;;
    "tar.gz"|"gz"|*)
	    FILEEXT="tar.gz"
	    COMMAND="sudo tar -czf"
	    CHANGEOWN="true"
	    ;;
esac

# NEED REALY CHOWN?
if [ "$USERN" == "$USER" ] ; then
    CHANGEOWN="false"
    COMMAND=`echo $COMMAND | sed -e "s/^sudo //g"`
fi

# EXECUTIONS
if [ "$CHANGEOWN" == "true" ] ; then
    sudo chown -R ${USERN}:${USERN} $FOLDERS
fi

if [ -f "$FILEN.$FILEEXT" ]; then
    mv -f "$FILEN.$FILEEXT" "$FILEN.bak.$FILEEXT"
fi

$COMMAND "$FILEN.$FILEEXT" $FOLDERS >/dev/null

if [ "$CHANGEOWN" == "true" ] ; then
    sudo chown -R $USER.$USER $FOLDERS "$FILEN.$FILEEXT"
fi

exit 0
