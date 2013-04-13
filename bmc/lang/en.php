<?php

// ******** EDIT THESE ********** //

$lang['lang'] = "en"; // Name of this pack
$lang['name'] = "English Lang pack"; // Name of this pack
$lang['ENCODING'] = "utf-8"; // Encoding


// ******** DONOT TOUCH THIS !! ********** //
if (isset($load_lang_pack) && $load_lang_pack == true) {
    return;
}

$lang['total_articles'] = "Posts";


// ******** START TRANSLATION HERE ********** //

// Short terms


$lang['all'] = "All";
$lang['any'] = "Any";
$lang['new'] = "New";
$lang['delete'] = "Delete";
$lang['clear'] = "Clear";
$lang['mod'] = "Modify";
$lang['save'] = " Save  ";
$lang['home'] = "Home";
$lang['update'] = "Update";
$lang['close'] = "Close";
$lang['back'] = "Back";

$lang['blog'] = "Page";
$lang['blogs'] = "Pages";
$lang['title'] = "Title";
$lang['summary'] = "Summary";
$lang['body'] = "Body";
$lang['author'] = "Author";
$lang['calendar'] = "Calendar";
$lang['rating'] = "Rating";
$lang['rate'] = "Rate";
$lang['votes'] = "Votes";
$lang['cat'] = "Visibility";
$lang['cats'] = "Visi bility";
$lang['blog_roll'] = "Pages list";
$lang['att_file'] = "Attached Files";
$lang['send'] = "Send this";
$lang['comments'] = "Comments";
$lang['stats'] = "Statistscs		";
$lang['unavaible'] = "- unavaible :(";


$lang['archive'] = "Archives";
$lang['search'] = "Search";
$lang['show'] = "Show";
$lang['adv_search'] = "Advanced search";
$lang['search_this'] = "Search this site";
$lang['recent_posts'] = "Recent posts";
$lang['link_title'] = "Buttons list seen on the left side of the page";
$lang['links'] = "Left buttons";
$lang['new_but'] = "-- create new --";

$lang['hidden'] = "Hidden";
$lang['open'] = "Open";
$lang['draft'] = "Draft";

// Common strings
$lang['str_by'] = "by";
$lang['str_on'] = "on";
$lang['str_all'] = "All";
$lang['posted_by'] = "Posted by";
$lang['edited_by'] = "Edited by";
$lang['str_more'] = "more"; // (3.1)


$lang['send_post'] = "Mail this";
$lang['send_post_title'] = "Mail this post to a friend";
$lang['post_comment'] = "Post a Comment";
$lang['view_comments'] = "View/Add comments";
$lang['print'] = "Printer friendly";
$lang['rate_this'] = "Rate the post";

// Printer friendly page

$lang['print_from'] = "Post from";
$lang['printed_from'] = "Printed from";

$lang['no_articles'] = "No posts were found in the database!";


$lang['powered'] = "Powered by";

// =======================
// New post page

$lang['post_title'] = "Post title";
$lang['post_keys'] = "Keywords   [For search engine support]";
$lang['post_format'] = "Input format";

$lang['post_attach'] = "File Attachments";
$lang['post_attach_clear'] = "Clear Attachments";
$lang['post_attach_mg'] = "Manage Attachments";

$lang['post_note'] = "( The post body is optional )";
$lang['post_smr'] = "Post Summary";
$lang['post_content'] = "Post body expanded";
$lang['post_html_cancel'] = "Cancel"; // (3.1)

$lang['post_normal'] = "Normal post";
$lang['post_date'] = "Post date (Enter in the format DD/MM/YY hh:mm:ss )&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Leave the field empty to set current date&time</small>";

$lang['post_draft'] = "Draft ? (Future post : set a date)";
$lang['post_hidden'] = "Hidden post?";
$lang['do_email'] = "Mail this to users?";
$lang['do_details'] = "Show the details (date, publisher, etc.)";

$lang['post_no_blog'] = "The requested page was not found";
$lang['closed_blog'] = "This page is closed to posting";
$lang['post_no_associate'] = "You cannot post in a page that you are not associated to"; // (3.1)
$lang['post_no_cat'] = "You are not allowed to view this entry";
$lang['post_no_mod'] = "You are not allowed to post/edit/delete this entry";
$lang['post_no_area'] = "You are not allowed in this area";

$lang['post_attached'] = "Attached files";
$lang['post_smile'] = "Smilies Info";
$lang['post_post_but'] = "  Post  ";
$lang['post_post_preview'] = "Preview"; // (3.1)
$lang['post_nest_msg'] = "Don't forget to save the parent post(this one).";
$lang['post_nest_tip'] = "New post added. ";

$lang['post_edit'] = "Edit: \"%title%\"";
$lang['post_rss_no'] = "The post was successfully added, however the rss/xml feed generator failed. Please check the permission of the /rss directory";

// =======================
// Send to friend form

$lang['snd_name'] = "Your name";
$lang['snd_email'] = "Your Email";

$lang['snd_title'] = "Send the post \"%title%\" to a friend";
// Donot remove the %title% . The article's title appears there

$lang['snd_email_req'] = "Enter atleast 1 email!";
$lang['snd_em1'] = "Friend's email #1";
$lang['snd_em2'] = "Friend's email #2";
$lang['snd_em3'] = "Friend's email #3";
$lang['snd_em4'] = "Friend's email #4";
$lang['snd_em5'] = "Friend's email #5";
$lang['snd_comments'] = "Your comments [Optional]";
$lang['snd_but'] = " SEND ";

$lang['snd_no'] = "Sending posts is disabled!";
$lang['snd_inv_email'] = "Invalid EMAIL address!";
$lang['snd_inv_email_msg'] = "You have entered an invalid email in the 'email' field!";
$lang['snd_inv_email_to_msg'] = "You have entered an invalid email in the 'to' field!";

$lang['snd_success'] = "<br><br><br><br>The post \"%article%\" was sent successfully to the following recipients";


// =======================
// Search

$lang['search_in'] = "Search in";
$lang['search_title'] = "Title";
$lang['search_content'] = "Content";
$lang['search_author'] = "Author name";
$lang['search_reslut_msg'] = "Search results for %key%";
$lang['search_resut_no'] = "No results were found matching your keyword!";
$lang['search_resut_no_key'] = "Keywords too short! Please use at least 3 characters!";


// =======================
// USERS

// Registration and user info

$lang['users'] = "Users";
$lang['user_box_txt'] = "Members"; ///////////////////////??????????????????
$lang['user_box_acc'] = "My account";
$lang['user_login'] = "Login";
$lang['user_important'] = "Are you sure you want to change\\n";
$lang['user_name'] = "Full name";
$lang['user_email'] = "Email";
$lang['user_card'] = "Card number";
$lang['user_no_card'] = "Club card - ";
$lang['user_no_c1'] = "none";
$lang['user_url'] = "Homepage";
$lang['user_pass0'] = "Old password";
$lang['user_pass1'] = "New password";
$lang['user_pass'] = "Password";
$lang['user_pass2'] = "Repeat password";
$lang['user_hobby'] = "Speciality";
$lang['user_location'] = "Location";
$lang['user_study'] = "Place of study";
$lang['user_birth'] = "Birth date";
$lang['user_icq'] = "ICQ";
$lang['user_profile'] = "Profile";
$lang['user_me'] = "About me";
$lang['user_vp'] = "View current picture";
$lang['user_cp'] = " No picture ";

$lang['user_total_posts'] = "Total posts";
$lang['user_total_cmts'] = "Total comments";
$lang['user_l_login'] = "Last login";

$lang['u'][0] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;---&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$lang['u'][1] = 'none';
$lang['u'][2] = '1 course';
$lang['u'][3] = '2 course';
$lang['u'][4] = '3 course';
$lang['u'][5] = '4 course';
$lang['u'][6] = '5 course';
$lang['u'][7] = '6 course';
$lang['u'][8] = 'graduated';
$lang['u_max'] = 8;
$lang['u_info'] = 'High education';


$lang['user_reg_title'] = "New user registration";
$lang['user_reg_but'] = "Register";
$lang['user_signup'] = "Sign in";

$lang['user_reg_info'] = "Number of club card";
$lang['user_reg'] = "Do you have a club card?";
$lang['user_reg_1'] = "I have card";
$lang['user_reg_2'] = "I don't have card";
$lang['user_reg_link'] = "If you want to buy a card, follow this link";


$lang['user_blogs'] = "Associated pages";
$lang['user_blogs1'] = "You can edit following pages";
$lang['user_short_user'] = "Login too short! Must be atleast 3 characters in length";
$lang['user_short_pass'] = "Password too short! Must be atleast 5 characters in length";
$lang['user_card_no'] = "Card id shoul be 5 or more digits!";
$lang['user_pass_nomatch'] = "Passwords do not match!";
$lang['user_pic'] = "Profile pic";
$lang['user_get_email'] = "Get news from this site?";
$lang['user_pic_show'] = "Display profile pic?";
$lang['pic_size_fail'] = "The maximum allowed file size for the profile picture is %size% KB!";
$lang['user_exists_msg'] = "The login or email you chose is already registered! ";
$lang['user_blog_no_sel'] = "Please select a page!";

$lang['user_reg_success_title'] = "Registration successful!";
$lang['user_reg_success_msg'] = "Thank you for registering!<br> Your account has been successfully setup and your account info has been mailed to your email";

$lang['user_welcome_subject'] = "Thank you for joining!"; // New user welcome email subject
$lang['user_notify_subject'] = "Notification: New user registration";
$lang['user_forgot_subject'] = "Forgot password request"; // Subject of the forgot password mail

$lang['user_no_accept'] = "Sorry! The administrator has chosen not to accept any user registrations at the moment. Please check back later.";


$lang['user_joined'] = "Date joined";
$lang['user_disp_id'] = "Display name";
$lang['user_disp_email'] = "Display email publicly";
$lang['user_disp_profile'] = "Do not display any data publicly";

// Login
$lang['logged'] = "You are logged as";
$lang['user_login_title'] = "User login";
$lang['user_logout'] = "Logout";
$lang['user_login_but'] = "Login";
$lang['last_login'] = "Last login";
$lang['user_login_remember'] = "Remember me?";
$lang['user_login_false'] = "Invalid login or password!";
$lang['user_cap_empty'] = "You must enter the code you can see on the picture";
$lang['user_cap_false'] = "You've entered wrong verification code";
$lang['user_cap'] = "Enter code seen on the picture";
$lang['forgot'] = "New password will be sent on your mailbox";
$lang['user_forgot_pass'] = "Forgot Password";
$lang['user_forgot_but'] = "Get my password";
$lang['user_forgot_false'] = "No user account was found with that email id!";
$lang['user_frozen'] = "You have been suspended by the administrator!";
$lang['user_forgot_send_msg'] = "Your password has been reset and has been sent to your email!";

// Panel
$lang['user_mbr_title'] = "Members area";
$lang['user_welcome'] = "Welcome to your page!";


$lang['user_level_info'] = "Your level is ";
$lang['user_level_0'] = "Frozen";
$lang['user_level_1'] = "Registered";
$lang['user_level_2'] = "Card owner";
$lang['user_level_3'] = "Moderator";
$lang['user_level_4'] = "Administrator";

$lang['level_info'] = "Your rights";
$lang['level_0'] = "none";
$lang['level_1'] = "Get news by mail";
$lang['level_2'] = "View closed articles";
$lang['level_3'] = "Edit posts";
$lang['level_4'] = "Full control";

$lang['user_post_new'] = "New post";
$lang['user_post_edit'] = "Edit posts";
$lang['user_post_list'] = "Pists list";
$lang['user_acc'] = "My account";


$lang['user_new_title'] = "Write a new post";
$lang['user_pass_need'] = "Change password";


// File manager
$lang['file_title'] = "Upload files";
$lang['file_fl'] = "File ";
$lang['file_but'] = " Upload ";
$lang['file_but_del'] = "Delete selected";
$lang['file_but_run'] = "Run / Download"; // (3.1)
$lang['file_del_msg'] = "Are you sure want to delete the selected files?";
$lang['file_add_but'] = "Attach Files";

$lang['file_img_resize'] = "Resize to thumbnail ?"; // (3.1)
$lang['file_img_insert'] = "Insert to post"; // (3.1)
$lang['file_img_insert_target'] = "Insert to :"; // (3.1)
$lang['file_img_insert_body'] = "Post body"; // (3.1)


$lang['file_fail'] = "Upload %num% failed!";
$lang['file_fail_size'] = "Invalid or Excess file size for file %num%";
$lang['file_fail_ext'] = "Invalid or restricted file extension for file %num%";
$lang['file_done'] = "File %num% uploaded successfully!";


// =======================
// Date / Calendar (3.1)

$lang['caln_tip'] = "Posts made on";
$lang['caln_next'] = "Next month";
$lang['caln_prev'] = "Previous month";


$lang['c'][0] = 'everyone';
$lang['c'][1] = 'only registered users';
$lang['c'][2] = 'only card owners';
$lang['c'][3] = 'only moderators';
$lang['c']['info'] = 'Information can be seen by %x%';
$lang['c']['info1'] = 'Information can be seen by';
$lang['c']['info2'] = "When you register you can see more info";


// Full Weekdays
$lang['date']['Sunday'] = 'Sunday';
$lang['date']['Monday'] = 'Monday';
$lang['date']['Tuesday'] = 'Tuesday';
$lang['date']['Wednesday'] = 'Wednesday';
$lang['date']['Thursday'] = 'Thursday';
$lang['date']['Friday'] = 'Friday';
$lang['date']['Saturday'] = 'Saturday';

// Weekdays Abbrivated
$lang['date']['Sun'] = 'Sun';
$lang['date']['Mon'] = 'Mon';
$lang['date']['Tue'] = 'Tue';
$lang['date']['Wed'] = 'Wed';
$lang['date']['Thu'] = 'Thu';
$lang['date']['Fri'] = 'Fri';
$lang['date']['Sat'] = 'Sat';

// Weekdays even shorter :)
$lang['date']['week_day_1'] = 'S';
$lang['date']['week_day_2'] = 'M';
$lang['date']['week_day_3'] = 'T';
$lang['date']['week_day_4'] = 'W';
$lang['date']['week_day_5'] = 'T';
$lang['date']['week_day_6'] = 'F';
$lang['date']['week_day_7'] = 'S';

// Months
$lang['date']['January'] = 'January';
$lang['date']['February'] = 'February';
$lang['date']['March'] = 'March';
$lang['date']['April'] = 'April';
$lang['date']['May'] = 'May';
$lang['date']['June'] = 'June';
$lang['date']['July'] = 'July';
$lang['date']['August'] = 'August';
$lang['date']['September'] = 'September';
$lang['date']['October'] = 'October';
$lang['date']['November'] = 'November';
$lang['date']['December'] = 'December';


$lang['d1'] = & $lang['date'];


// Months abbrivated
$lang['date']['Jan'] = 'Jan';
$lang['date']['Feb'] = 'Feb';
$lang['date']['Mar'] = 'Mar';
$lang['date']['Apr'] = 'Apr';
$lang['date']['May'] = 'May';
$lang['date']['Jun'] = 'Jun';
$lang['date']['Jul'] = 'Jul';
$lang['date']['Aug'] = 'Aug';
$lang['date']['Sep'] = 'Sep';
$lang['date']['Oct'] = 'Oct';
$lang['date']['Nov'] = 'Nov';
$lang['date']['Dec'] = 'Dec';


// =======================
// ADMIN

// General

$lang['admin'] = "Admin";
$lang['admin_panel'] = "Administration panel";
$lang['admin_not'] = "NOT ADMIN!";
//$lang['admin_no_blog']= "No pages selected";
//$lang['admin_blog_clr']="         Clear          ";
$lang['neither'] = "  ---  none  ---";

$lang['admin_welcome'] = "Administration area";
$lang['admin_mode'] = "boastMachine";
$lang['admin_legend'] = "C - Number of comments &nbsp;&nbsp;,&nbsp; S - Status [ If checked, hidden/frozen ] &nbsp;&nbsp;,&nbsp; X - Delete";


$lang['sort'] = "Click to sort messages";
$lang['admin_home'] = "Admin Home";
$lang['admin_system'] = "System";
$lang['admin_author'] = "Users";
$lang['admin_word'] = "Word Filter";
$lang['admin_ip_title'] = "IP Filter";
$lang['admin_delall'] = "Delete All";
$lang['admin_backup_rstr'] = "Backups";
$lang['admin_theme'] = "Themes";
$lang['admin_block'] = "Block Content";
$lang['admin_theme_editor'] = "Template editor";
$lang['admin_lang'] = "Languages";
$lang['admin_set'] = "Settings";
$lang['admin_status'] = "Status";
$lang['admin_file'] = "File Manager";
$lang['admin_user_list'] = "List users";
$lang['admin_user_add'] = "Add user";
$lang['admin_user_mail'] = "Mail users";
$lang['admin_user_search'] = "Search users";
$lang['admin_users_online'] = "Users currently online"; // (3.1)

// Stats (3.1)
$lang['admin_stats_blogs'] = "Total pages";
$lang['admin_stats_users'] = "Total users";
$lang['admin_stats_posts'] = "Total posts";
$lang['admin_stats_cmts'] = "Total comments";

// Pages
$lang['admin_blog_title'] = "Site pages";
$lang['admin_blog_manage'] = "Manage page";
$lang['subcat'] = "Subcathegories";
$lang['admin_blog_date'] = "Created on ";
$lang['admin_blog_new'] = "Create webpage";
$lang['admin_blog_new_file'] = "Static filename";
$lang['admin_blog_new_file_help'] = "The name for static .php file which sould be created in the base directory\\nThe page will be accessed by calling this static file\\nEg: giving my_wepage will create a file named my_wepage.php and this page will be accessed from http://klutch.com.ua/page/my_blog.php";
$lang['admin_blog_new_file_no'] = "The static .php file exists in the base directory! Please choose a different filename!";
$lang['admin_blog_new_name'] = "Page name";
$lang['admin_blog_theme'] = "Page theme";
$lang['admin_blog_info'] = "Search engine keywords";
$lang['redirect'] = "Redirect";
$lang['admin_blog_redirect'] = "Redirect address";
$lang['admin_blog_frozen'] = "View only for card owners";
$lang['admin_blog_new!'] = "New page created!";
$lang['admin_blog_mod'] = "Сторінка змінена!";
$lang['index.php'] = "<br><br>Caution! File index.php is a default loader. It should always be present in the site!";
$lang['admin_blog_new_file_name1'] = "Page file has been set to %file%. \\n Page link has been set to http://klutch.com.ua/%file%";
$lang['admin_blog_users'] = "Allow card ownwers to post";
$lang['admin_blog_new_err'] = "A page with the same name exists!";
$lang['admin_blog_del_title'] = "Are you sure want to delete this page?";
$lang['admin_blog_del_msg'] = "All the posts, comments, page settings etc.. would be permanently lost!";
$lang['amin_blog_no'] = "No page with that id was found!";
$lang['list_posts'] = "List entries";

// =======================
// Search users and Posts
$lang['admin_search_short'] = "Keywords too short!";
$lang['admin_search_no'] = "No results were found matching your criteria";
$lang['admin_search_posts_selpage'] = "page where the searching is to be done";
$lang['admin_search_results'] = "%num% results found";
$lang['admin_search_users'] = "Search users";
$lang['admin_search_users_show'] = "Show users";
$lang['admin_search_posts'] = "Search posts";
$lang['pages_show'] = "Show on pages&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$lang['admin_search_user_regd'] = "and registered";

// Mail logs
$lang['admin_mail_logs'] = "Logs";
$lang['admin_mail_1'] = "Generated when users click \"Send to a friend\"";
$lang['admin_mail_logs_no'] = "The logs are empty";
$lang['admin_mail_logs_by'] = "Sent by %email% on ";
$lang['admin_mail_view'] = "View Logs";
$lang['admin_mail_clear'] = "Clear Logs";

//$lang['admin_stat_sel_but']="Change Status";
$lang['admin_del_sel_but'] = "Delete selected";
$lang['admin_sel_h'] = "Select hidden";
$lang['admin_sel_d'] = "Select draft";
$lang['admin_sel_s'] = "Select my posts";


// Referer logging
$lang['admin_ref_time'] = "Time";
$lang['admin_ref_ip'] = "IP address";
$lang['geo_ip'] = "See user coordinates on map";
$lang['admin_ref_url'] = "Referrer url";

// Link manager (3.1)
$lang['admin_link_add_to'] = "Seen on pages";
$lang['admin_link_but_mod'] = " Add / Edit ";
$lang['admin_link_title'] = "Link Title";
$lang['admin_link_url'] = "Link URL";
$lang['admin_link_desc'] = "Link Description";


// Theme editor
$lang['admin_editor_dir'] = "Theme directories";
$lang['admin_editor_files'] = "File list";
$lang['admin_editor_path'] = "Path";
$lang['admin_editor_sel_dir'] = "Select a directory";
$lang['admin_editor_sel_file'] = "Select a file";
$lang['admin_editor_error'] = "Could not save the edited file! Please check the file permission!";

// Word filter
$lang['admin_bad_title'] = "Word Filter";
$lang['admin_bad_words'] = "Enter words to be filtered, one per line";
$lang['admin_file_no'] = "File uploading is not permitted!";


// cardhol
$lang['admin_card_title'] = "Cardholders";
$lang['admin_card_words'] = "Avoid symbol ;";


// Posts
$lang['admin_post_title'] = "Post title";
$lang['the_date'] = "Date";
$lang['author'] = "Author";
$lang['admin_post_act'] = "Action";
$lang['admin_post_view'] = "View post";
$lang['admin_post_cmt'] = "Comments";
$lang['admin_post_no'] = "No posts were found in this page!";

$lang['admin_post_search'] = "Search posts";
$lang['admin_post_show'] = "Show posts from";
$lang['admin_post_week'] = "This week";
$lang['admin_post_month'] = "This month";
$lang['admin_post_last_month'] = "Month ago";
$lang['admin_post_last_6month'] = "2-12 months ago";
$lang['admin_post_last_year'] = "Year & more ago";
$lang['admin_del_chk'] = "Invert selection";
$lang['admin_del_n'] = "Normal";
$lang['admin_del_h'] = "Hidden";
$lang['admin_del_d'] = "Draft";

$lang['del_post_confirm'] = "Are you sure want to delete the selected post(s) ?";


$lang['edit'] = " Edit ";
$lang['del'] = " Delete ";
$lang['admin_but_du'] = " Delete user";
$lang['admin_but_dp1'] = " Delele all user's posts";
$lang['admin_but_dc1'] = " Delele all user's comments";
$lang['admin_but_dp'] = " Del. posts";
$lang['admin_but_dc'] = " Del. comments";


// Mail all users
$lang['admin_mail_subj'] = "Mail subject";
$lang['admin_mail_level'] = "With level";
$lang['admin_mail_msg'] = "Message";
$lang['admin_mail_send'] = "Send message";
$lang['admin_mail_keywords'] = "The following quick tags can be used in the message";

$lang['admin_mail_go'] = "Mailing %num% users...............";
$lang['admin_mail_success'] = "Successfully mailed %num% users!";


$lang['mail_new'] = "Welcome mail";
$lang['mail_new1'] = "New user mail subject!";
$lang['mail_new2'] = "New user mail text!";


// IP blocking
$lang['admin_block_title'] = "Block/Unblock IPs";
$lang['admin_block_ip'] = "Enter IPs to be blocked one per line.<br>Enter a full IP or a partial one. <br>eg: 202.155.26.33 or 202.144.";


// Backup and restore
$lang['admin_backup_title'] = "Backup/Restore data";
$lang['admin_backup_restore'] = "Restore data";
$lang['admin_backup_delete'] = "Delete";
$lang['admin_backup_previous'] = "Previous backups";
$lang['admin_backup_but'] = "Backup all Data";
$lang['admin_backup_gzip'] = "(Compress the backup using gzip?)";
$lang['admin_backup_note'] = "You will be able to upload the backup file and restore the data at any time";

$lang['admin_restore_title'] = "Upload a backup file and restore the data";
$lang['admin_restore_warn'] = "(WARNING! This will destroy existing data!)";

$lang['admin_restore_fail'] = "Upload of backup file failed! Please check the /backup directory's permission !";
$lang['admin_restore_but'] = "Upload and Restore";
$lang['admin_restore_fail'] = "Database restore failed!";
$lang['admin_restore_ok'] = "Database restored successfully!";

// Themes
$lang['admin_theme_title'] = "Theme management";
$lang['admin_theme_current'] = "Current Theme";
$lang['admin_theme_info'] = "( This is going to be the global theme applicable for all pages. This wont affect their individual theme setting of the pages )";
$lang['admin_theme_apply_but'] = "Apply theme";
$lang['admin_theme_del_but'] = "Delete theme";
$lang['admin_theme_del_msg'] = "Are you sure want to permanently remove the selected theme from the server?";
$lang['admin_theme_del_no'] = "Sorry! You cant delete the theme that you are currently using!";

// Language packs
$lang['admin_lang_title'] = "Language Packs";
$lang['admin_lang_current'] = "Current Pack";
$lang['admin_lang_but'] = "Select Language";
$lang['admin_lang_up'] = "Upload a language pack";
$lang['admin_lang_up_ow'] = "Overwrite if exists?";
$lang['admin_lang_up_ow_no'] = "The language pack was not uploaded as a file with the same name exists!";
$lang['admin_lang_up_no'] = "File upload failed! Please check the /lang/ directory permission!";
$lang['admin_lang_bad'] = "Corrupt or bad language pack! Please ensure that you are uploading a valid lang file!";
$lang['admin_up_but'] = " Upload ";
$lang['admin_lang_del_but'] = "Delete language pack";
$lang['admin_lang_del_msg'] = "Are you sure want to completely delete this language pack?";
$lang['admin_lang_del_no'] = "You cannot delete the lang pack currently in use!";

// Users
$lang['admin_user_list'] = "User list";
$lang['user_level'] = "Level";
$lang['admin_user_total'] = "Total users";
$lang['admin_user_admin_total'] = "Total admins";
$lang['admin_user_suspended'] = "Suspended users";
$lang['admin_user_edit'] = "Edit user";
$lang['admin_user_del'] = "Delete user";
$lang['admin_user_del_post'] = "Warning! Are you sure want to delete posts made by this user?";
$lang['admin_user_del_cmt'] = "Warning! Are you sure want to delete comments made by this user?";
$lang['admin_user_atleast'] = "There must be atleast 1 user in the system!";
$lang['admin_user_nodel'] = "You cant delete the super admin!";
$lang['admin_user_del_msg'] = "Are you sure want to delete the author and all his posts?";
$lang['admin_user_add'] = "Add User";
$lang['admin_user_add_bt'] = " ADD ";

// Settings
$lang['admin_sett_aemail'] = "From email";
$lang['site_title'] = "Site keywords for search engines";
$lang['admin_sett_desc'] = "Site description (Contacts, etc.)";


$lang['admin_sett_users'] = "Accept user registrations?";
$lang['admin_sett_new_welcome'] = "Send new users a welcome mail?";
$lang['admin_sett_new_notify'] = "Notify you when a new user signs up?";
$lang['admin_sett_cmt'] = "Enable commenting";
$lang['admin_sett_vote'] = "Enable Voting/Rating?";
$lang['admin_sett_xml'] = "Enable RSS(XML) syndication?";


$lang['admin_sett_total'] = "Total posts to be shown";
$lang['admin_sett_ppage'] = "Posts per page";
$lang['admin_sett_order'] = "Order of the page in menu bar";
$lang['admin_sett_html'] = "Default language to post";

$lang['admin_sett_chk_yes'] = " Yes ";
$lang['admin_sett_chk_no'] = " No ";


// Settings tool tips

$lang['admin_sett_tip_email'] = "\'From\' email address on mails sent out";
$lang['admin_sett_tip_site_title'] = "Title of your site";
$lang['admin_sett_tip_desc'] = "Description shown in the footer of the site";

$lang['admin_sett_tip_sendm'] = "Subject of the mail sent from the \'send to friend\' form";

$lang['admin_sett_tip_theme'] = "Chooze the style fo the page - theme";
$lang['admin_sett_tip_redirect'] = "Redirect when entering the page to following address";
$lang['admin_sett_tip_frozen'] = "If you want content of this page visible for registered users ony, check this";
$lang['admin_sett_tip_ppage'] = "Posts to be shown per page";
$lang['admin_sett_tip_total'] = "Total posts to be displayed. Rest of the posts will be archived";
$lang['admin_sett_tip_order'] = "The order of the page in the menu";

$lang['admin_sett_tip_users'] = "Allow new users to register themselves on your site";

$lang['admin_sett_tip_new_welcome'] = "Send the new users a welcome mail with their account info?";
$lang['admin_sett_tip_new_notify'] = "Notify you with an email when someone signs up?";

$lang['admin_sett_tip_cmt'] = "Allow users to comment on your posts?";

$lang['admin_sett_tip_vote'] = "Enable Rating/Voting posts?";
$lang['admin_sett_tip_xml'] = "Enable publishing of XML feeds so that search engines and content aggregators can index your page feeds";
$lang['admin_sett_tip_html'] = "Allow users to post in HTML format?";
$lang['admin_sett_tip_files'] = "Allow users to upload files and attach them with posts?";


// =======================
// Comments page

$lang['del_cmts_del_but'] = " Delete All Comments ";
$lang['del_cmt_msg'] = "Are you sure want to delete all comments for this post?";

$lang['del_cmt_one'] = "Are you sure want to delete this comment?";

$lang['cmt_no_one'] = "No comments have been made on this post yet!";
$lang['del_cmts_save_but'] = " Save Changes ";

$lang['cmt_posted_by'] = "Posted by";
$lang['cmt_posted_date'] = "on date";


$lang['cmt_post_ttl'] = "Post a new comment";
$lang['cmt_empty_back'] = "Please go back and correct";
$lang['cmt_empty_field'] = "Empty %field% ! Please go back and correct!";
$lang['cmt_no_comment'] = "Sorry! Commenting is disabled!";
$lang['cmt_no_comment_post'] = "Commenting on this post is disabled!";
$lang['del_cmt_sess'] = "You can post only one comment per session on a post!";

// User comment posting page

$lang['cmt_name'] = "Name";
$lang['cmt_email'] = "Email";
$lang['cmt_url'] = "URL";
$lang['cmt_comment'] = "Comments";
$lang['cmt_guest_no'] = "You need to be logged in to post comments. Please login <a href=\"login.php\">here</a>";
$lang['cmt_thread_reply'] = "Reply to this comment"; // (3.1)
$lang['cmt_thread_reply_id'] = "Reply to comment id"; // (3.1)
$lang['cmt_notfiy'] = "Notify me when someone replies"; // (3.1)
$lang['cmt_notfiy_subject'] = "New comment notification mail"; // (3.1)
$lang['cmt_verify'] = "Verification code"; // (3.1)
$lang['cmt_verify_wrong'] = "Sorry! You entered a WRONG verification code!"; // (3.1)
$lang['cmt_submit_but'] = " Post ";


// =======================
// General Error messages


$lang['error_no_title1'] = "You haven't entered title!";
$lang['error_no_numeric'] = "The entered value is not a number";
$lang['error_no_src1'] = "You haven't entered summary!";
$lang['post_pass_invalid'] = "Oops! You entered the wrong password!";
$lang['empty_fields'] = "Oops! You missed some form fields! Please recheck.";
$lang['incorrect_email'] = "Oops! You entered incorrect e-mail.";
$lang['denied'] = 'Access Denied!';
$lang['err_write'] = "Cannot write to the directory";
$lang['no_file'] = "Unable to read the file %file%";

$lang['no_id'] = "No post was found with that id !";
$lang['no_user'] = "No user was found with that id !";
$lang['no_archive'] = "No Posts were found in the month %date%";
$lang['no_blog'] = "The page you are trying to access does not exist!";
$lang['no_data'] = "No data available";
$lang['no_data_avail'] = "No posts currently available";
$lang['no_cat'] = "No visibility was found with the id %id%";
$lang['no_cat_posts'] = "No posts were found with the visibility %cat% !";
$lang['no_logs'] = "No logs";
$lang['admin_clr_log_msg'] = "Unable to write to the log.txt file!<br>Please check whether the file exists and its permission is 777";
$lang['admin_log_write_msg'] = "Cannot write to the LOG file!";
$lang['banned'] = "You're banned!";
$lang['no_user'] = "No user with that ID was found";
$lang['profiles_no_pub'] = "The user has chosen not to display his profile";
$lang['blog_frozen'] = "The page is only for card owners";
$lang['user_frozen'] = "The user has been frozen by the Administrator";
$lang['rss_no_blog'] = "Cannot generate RSS feed! The page you requested doesn't exist!";


// Thank you for contributing this language pack to the boastMachine community

$lang['wr_suc'] = "Users written successsfully";
$lang['rd_suc'] = "Users read successsfully";
$lang['wr_unsuc'] = "Users written with ERROR";
$lang['rd_unsuc'] = "Users read  with ERROR";
$lang['export'] = " Export ";
$lang['import'] = " Import ";

$lang['done'] = "Operation success";

?>
