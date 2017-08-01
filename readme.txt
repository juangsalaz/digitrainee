For All CMS Version :

It require you a little bit of programming skilled but it already made to be ready used.

1. You put all the files include defavid.php and other but not includetop.php and includebottom.php on the top level of domain can be accessible with : http://www.example.com/defavid.php or http://defa.example.com/defavid.,php

2. You put includetop.php and includebottom.php on the cms level of domain can be anywhere such as top level of domain , sub level of domain.

3.Add include('includetop.php'); at the most top of the php files that display content for cms usually it is index.php and put include('includebottom.php'); at the most bottom of the same php files.

That should do the trick. ;)

FAQS :


Our software doesn't send you real original video files which make some browser video player cannot play the video.

Important : Beaware of CMS bring to download leaked in view source link.
Questions ? : Please Read Our Defa Protector FAQ :
https://www.juthawong.com/defa-protector-faq/

This Software Works on Defa Range Theory

If you like our software . Please Donate us . We earn very little and work hard to give you the best quality software for free
Donate us : http://www.juthawong.com/donate

Common Problems : Video doesn't play. It coming from 2 problems. 1. Server Configuration 2.Bad Installation
1.Server Configuration. It is complicated but normally default lampp,xampp, mampp and wampp are works
Requirement Function : http_response_code , get_headers() , header , $_SERVER and HTTP_RANGE
Try look at all php files and view error code which given which function is not yet install or not working

2.Bad Installation.
Try Backup .htaccess and delete . Usually for Security Wordpress plugin that stop wordpress from accessing enable.php and defavid.php which cause error.
Try access defavid.php and enable.php that it can be accessible or not.

Usually defavid.php comes with 1 error about filename which you can ignore and enable.php by default and working will show nothing.
Hope This Help 