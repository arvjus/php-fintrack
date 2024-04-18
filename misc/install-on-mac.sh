#!/bin/sh

rm -rf /Library/Fintrack
mkdir /Library/Fintrack
cp misc/org.zv.fintrack.plist /Library/LaunchDaemons
cp -r artisan vendor bootstrap app public server.php misc/run.sh /Library/Fintrack

echo "sudo launchctl load -w /Library/LaunchDaemons/org.zv.fintrack.plist"
#sudo launchctl load -w /Library/LaunchDaemons/org.zv.fintrack.plist 
#sudo launchctl unload -w /Library/LaunchDaemons/org.zv.fintrack.plist 

