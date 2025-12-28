#!/bin/bash

i=$*

if [ -f $i ]; then
  b=$(basename $i)
  if [ ! -f images/$b ]; then
    echo creating smaller image for $i...
    magick -size 2048x2048 $i images/$b
  else
    echo smaller image for $i exists
  fi
fi
