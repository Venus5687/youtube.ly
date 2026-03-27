# DISCLAIMER
This project is a project for the purpose of preservation and research, so with that said, let's continue.
# youtube.ly
A very unstable, YouTube Shorts to Musical.ly proxy server.
# How it works
It gets the latest YouTube Shorts from the specified channels, and then translates the format Invidious gives to the format the musical.ly app wants.
# Known bugs
The app may display "original sound" with the wrong creator's name in the track name.
# Known working app versions
3.0.1: working\
4.0.0: working\
4.5.0: working
# How to set the server up
**Requirements**\
A legacy iOS device (recommended iOS versions: 7.x, 8.x, 9.x)\
The musical.ly app (recommended version: 4.5.0)\
Flex 2 (if your iOS version is 7 or 8), or Flex 3 (if your iOS version is 9)\
**How to set it up (locally)**
1. Download and install XAMPP from here: https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.2.12/xampp-windows-x64-8.2.12-0-VS16-installer.exe
2. Download this ZIP file containing the latest files from this repository and extract the contents of "youtube.ly-master" in "C:\xampp\htdocs": https://github.com/Venus5687/youtube.ly/archive/refs/heads/master.zip \
Optional step: If you want to change the Invidious instance it uses (I recommend ones without a bot check), modify the /rest/v2/musicals/hot.php, /rest/v2/musicals/feed.php, and serve.php files, to use the instance you want instead of the default one (the default instance URL is "http://invidious.kemonomimi.nl").
3. Put the YouTube channel IDs you want to show in the app in the "$channels" array in the /rest/v2/musicals/hot.php and /rest/v2/musicals/feed.php files, and then in the same files, replace "localhost:4000" with ```(your computer's IP address):(server port)```.\
To find a YouTube channel ID: search the channel's name in your favorite Invidious instance, then click on the channel, and the URL should look like this: https://(Invidious instance)/channel/(channel ID), after that, copy ONLY the channel ID part of the URL.
4. Open the XAMPP Control Panel as an administrator because if you don't, it will throw an error on some actions like exiting the program.
5. Start "Apache" by clicking the "Start" button next to the "Apache" text. If it gives a port error, open the file "C:\xampp\apache\conf\httpd.conf" and search for:
```
Listen 80
ServerName localhost:80
```
And replace it with:
```
Listen 4000
ServerName localhost:4000
```
The server should now be set up!
# Patching the app (with Flex)
1. Open Flex 2 or Flex 3.
2. Tap the "+" button.
3. Scroll down and tap "musical.ly".
4. Now tap your newly created patch called "musical.ly Patch".
5. Tap "Add Units".
6. Tap "musical.ly" and then tap "Process" if asked to process it.
7. Search "setServerURL".
8. Tap "setServerURL" and make sure it says "MLClient".
9. If you see a checkmark next to "setServerURL", go back until you see the "Units" screen.
10. Now tap "Unit for -(void) setServerURL:(id)".
11. Tap "pass-through" below the "Argument #1 (id)" text.
12. Set "Override Type" to "NSString".
13. Set "Override Value" to your server URL (so ```(your computer's IP address):(server port)```).
14. Go all the way back and enable the patch.\
The app should now be patched!
# Troubleshooting
**XAMPP throws errors when I try to do this!**\
Make sure you ran the XAMPP Control Panel as an administrator.\
**Flex 3 crashes when I try to process the app!**\
Get an older beta version of Flex 3.\
**The app can't connect to my server!**\
Make sure that your legacy iOS device is connected to the same Wi-Fi network as the server.\
**Some videos don't load!**\
Try visiting the Invidious instance's URL in your web browser to see if it works.\
If it works, unfortunately, the simplest solution to this is either waiting, or if they keep not loading, reinstall the app.\
**I am stuck on the log in screen!**\
Use version 4.5.0, it has the "explore first" button, which you can tap to enter the app without logging in.
