#!/bin/bash

i=$*

if [ -f $i ]; then
  b=$(basename $i)
  if [ ! -f thumbs/$b.jpg ]; then
    echo creating thumbnail for $i...
    convert -geometry 240x240 $i[10] thumbs/$b.jpg
  else
    echo thumbnail for $i exists
  fi
fi
