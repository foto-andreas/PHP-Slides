#!/bin/bash

mkdir -p thumbs
if [[ "$*" == --replace ]]; then
  rm -f thumbs/*
fi

for i in images/*.{jpg,jpeg,png,JPG,JPEG,PNG}; do
  if [ -f $i ]; then
    b=$(basename $i)
    if [ ! -f thumbs/$b ]; then
      echo creating thumbnail for $i...
      convert -geometry 240x240 $i thumbs/$b
    else
      echo thumbnail for $i exists
    fi
  fi
done

for i in *.{mp4,MP4}; do
  if [ -f $i ]; then
    b=$(basename $i)
    if [ ! -f thumbs/$b.jpg ]; then
      echo creating thumbnail for $i...
      convert -geometry 240x240 $i[10] thumbs/$b.jpg
    else
      echo thumbnail for $i exists
    fi
  fi
done
