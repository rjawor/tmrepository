#!/bin/sh

SRC_FILE=$1
SRC_LANG=$2
TRG_FILE=$3
TRG_LANG=$4

ESERIX_HOME="/home/rjawor/programs/eserix/"
HUNALIGN_HOME="/home/rjawor/programs/hunalign-1.1/"

antiword -w 0 $SRC_FILE | sed '/^$/d' | sed 's/\t/ /g' > $SRC_FILE"_txt"
antiword -w 0 $TRG_FILE | sed '/^$/d' | sed 's/\t/ /g' > $TRG_FILE"_txt"

cat $SRC_FILE"_txt" | $ESERIX_HOME"build/bin/eserix" -r $ESERIX_HOME"srx/rules.srx" -l $SRC_LANG > $SRC_FILE"_txt_splitted"
cat $TRG_FILE"_txt" | $ESERIX_HOME"build/bin/eserix" -r $ESERIX_HOME"srx/rules.srx" -l $TRG_LANG > $TRG_FILE"_txt_splitted"

TEMP_DICTIONARY="/tmp/hunalign.dic"

rm -f $TEMP_DICTIONARY
touch $TEMP_DICTIONARY

$HUNALIGN_HOME"src/hunalign/hunalign" -text -utf -realign $TEMP_DICTIONARY $SRC_FILE"_txt_splitted" $TRG_FILE"_txt_splitted" > $SRC_FILE"_aligned.txt"

