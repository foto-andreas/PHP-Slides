#!/bin/bash

i=$*

if [ -f $i ]; then
  b=$(basename $i)
  if [ ! -f thumbs/$b ]; then
    echo creating thumbnail for $i...
    convert -geometry 240x240 $i thumbs/$b
  else
    echo thumbnail for $i exists
  fi
fi
