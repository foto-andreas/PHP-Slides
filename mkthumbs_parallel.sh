#!/bin/bash

mkdir -p thumbs
if [[ "$*" == --replace ]]; then
  rm -f thumbs/*
fi

ls -1 images/*.{jpg,jpeg,png,JPG,JPEG,PNG} 2>/dev/null | xargs -P 6 -I @ ./image.sh @
ls -1 images/*.{mp4,MP4,mov,MOV} 2>/dev/null | xargs -P 6 -I @ ./video.sh @
