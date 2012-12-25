<!-- Top navigation bar -->
<?php
    $url_path = Ming_Factory::getDocument()->getPublicPath();
    $user = Ming_Factory::getSession()->get('auth');

?>
<div id="topNav">
    <div class="fixed">
        <div class="wrapper">
            <div class="welcome">
                <a href="#" title="">
                    <img src="images/userPic.png" alt="" />
                </a>
                <span>
                    <?php
                        if(!empty($user)){
                            echo 'Hello '.strtoupper($user['username']);
                        }else{
                            ?>
                            <a href="<?php echo $url_path.'/auth/sign_in'?>">Đăng nhập</a>
                            <?php
                        }
                    ?>
                </span>
            </div>
            <?php if($user){?>
                <div class="userNav">
                    <ul>
                        <li><a href="#" title=""><img src="images/icons/topnav/profile.png" alt="" /><span>Profile</span></a></li>
                        <li><a href="#" title=""><img src="images/icons/topnav/tasks.png" alt="" /><span>Tasks</span></a></li>
                        <li class="dd"><img src="images/icons/topnav/messages.png" alt="" /><span>Messages</span><span class="numberTop">8</span>
                            <ul class="menu_body">
                                <li><a href="#" title="">new message</a></li>
                                <li><a href="#" title="">inbox</a></li>
                                <li><a href="#" title="">outbox</a></li>
                                <li><a href="#" title="">trash</a></li>
                            </ul>
                        </li>
                        <li><a href="#" title=""><img src="images/icons/topnav/settings.png" alt="" /><span>Settings</span></a></li>
                        <li><a href="<?php echo $url_path.'/auth/sign_out'?>" title=""><img src="images/icons/topnav/logout.png" alt="" /><span>Logout</span></a></li>
                    </ul>
                </div>
                <div class="fix"></div>
            <?php }?>
        </div>
    </div>
</div>