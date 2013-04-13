<?php

// ******** EDIT THESE ********** //

$lang['lang'] = "ua"; // Name of this pack
$lang['name'] = "Русский язык"; // Name of this pack
$lang['ENCODING'] = "windows-1251"; // Encoding


// ******** DONOT TOUCH THIS !! ********** //
if (isset($load_lang_pack) && $load_lang_pack == true) {
    return;
}


// ******** START TRANSLATION HERE ********** //

// Short terms ссилка - ссылка
$lang['total'] = "Всего";
$lang['prev'] = "предыдущая";
$lang['next'] = "следующая";
$lang['or'] = "Или";
$lang['change'] = "Изменить";
$lang['all'] = "Всех";
$lang['anywere'] = "Везде";
$lang['any'] = "Любая";
$lang['any1'] = "Любой";
$lang['new'] = "Новый";
$lang['edit'] = " Редактировать ";
$lang['delete'] = "Удалить";
$lang['del'] = "Уничтожить";
//$lang['clear']="Очистить";
$lang['mod'] = "Изменить";
$lang['save'] = " Сохранить  ";
$lang['home'] = "Домашняя страница";
$lang['update'] = "Сохранить";
$lang['close'] = "Закрыть";
$lang['back'] = "Назад";

$lang['posts'] = "Публикаций";
$lang['blog'] = "Страница";
$lang['blogs'] = "Страницы";
$lang['title'] = "Заголовок";
$lang['summary'] = "Коротко";
$lang['body'] = "Тело публикации";
$lang['author'] = "Автор";
$lang['the_date'] = "Дата";
$lang['calendar'] = "Календарь";
$lang['rating'] = "Рейтинг";
$lang['rate'] = "Рейтинг";
$lang['votes'] = "Голоса";
$lang['access'] = "Доступ";
$lang['blog_roll'] = "Страницы:";
$lang['send'] = "Прислать";
$lang['comments'] = "Комментарии";
$lang['unavaible'] = "- недоступный :(";


$lang['archive'] = "Архив";
$lang['search'] = "Поиск";
$lang['show'] = "Показать";
$lang['adv_search'] = "Расширенный поиск";
//$lang['search_this']="Поиск по этому сайту";
$lang['recent_posts'] = "Последние публикации";
$lang['list_posts'] = "Список публикаций";
$lang['new_but'] = "-- новая --";

$lang['normal'] = "Нормальный";
$lang['hidden'] = "Скрытый";
$lang['open'] = "Открытый";
$lang['draft'] = "Черновик";

// Common strings
$lang['str_by'] = "Опубликовано"; //comments
$lang['str_on'] = " "; //date
$lang['str_all'] = "Все";
$lang['posted_by'] = "Опубликовано";
$lang['edited_by'] = "Отредактировано";
$lang['str_more'] = "подробнее";


$lang['send_post'] = "Выслать на email";
$lang['send_post_title'] = "Выслать другу по электронной почте";
$lang['post_comment'] = "Написать комментарий";
$lang['view_comments'] = "Просмотреть комментарии";
$lang['print'] = "Версия для печати";
$lang['rate_this'] = "Оценить";

// Printer friendly page

$lang['print_from'] = "Публикация с";
$lang['printed_from'] = "Напечатано с";


$lang['powered'] = "Разработка сайта";

// =======================
// New post page

$lang['post_title'] = "Оглавление";
$lang['post_keys'] = "Ключевые слова для поисковых машин";
$lang['post_format'] = "Формат ввода";

$lang['post_attach'] = "Прикрепленные файлы";
$lang['post_attach_clear'] = "Очистить прикрепленные файлы";
$lang['post_attach_mg'] = "Изменить прикрепленные файлы";

$lang['post_note'] = "заполнять поле \"Развернуто\" необязательно";
$lang['post_smr'] = "Коротко";
$lang['post_content'] = "Развернуто";
$lang['post_icon'] = "Иконка публикации";
$lang['post_icon_resize'] = "Уменьшить к размеру";
$lang['cancel'] = "Отмена"; // (3.1)

$lang['post_normal'] = "Нормальная публикация";
$lang['post_date'] = "Дата опубликования (В формате день/месяц/год ч:мин)<br/><small>Оставьте поле пустым и автоматически будет записана текущая дата<br/></small>";

$lang['post_draft'] = "Отложенная (публикуется в заданный день)";
$lang['post_hidden'] = "Скрытая";
$lang['do_email'] = "Разослать всем по электронной почте";
$lang['do_details'] = "Отображать детали(дату, автора и т.п.)";


$lang['post_attached'] = "Прикрепленные файлы";
$lang['post_smile'] = "Описание смайликов";
$lang['post_post_but'] = " Опубликовать ";
$lang['post_post_preview'] = " Предварительный просмотр ";
$lang['post_nest_2'] = "Не забудьте сохранить родительскую публикацию";
$lang['post_nest_1'] = "Публикация успешно добавлена.";
$lang['post_nest_3'] = " (эту, что перед Вами)";

$lang['post_edit'] = "Редактировать: \"%title%\"";
$lang['post_rss_no'] = "The post was successfully added, however the rss/xml feed generator failed. Please check the permission of the /rss directory";
$lang['del_post_confirm'] = "Вы уверенные что хотите уничтожить отмеченные публикации?";
// =======================

// Send to friend form

$lang['snd_name'] = "Ваше имя";
$lang['snd_email'] = "Ваш email";

$lang['snd_title'] = "Отправить публикацию \"%title%\" другу";
// Donot remove the %title% . The article's title appears there

$lang['snd_email_req'] = "Введите хотя бы один адрес!";
$lang['snd_em1'] = "Email #1";
$lang['snd_em2'] = "Email #2";
$lang['snd_em3'] = "Email #3";
$lang['snd_em4'] = "Email #4";
$lang['snd_em5'] = "Email #5";
$lang['snd_comments'] = "Ваш комментарий (необязательно)";
$lang['snd_but'] = " Отправить ";

$lang['snd_no'] = "Отправка почты отключена!";
$lang['snd_inv_email_to_msg'] = "Вы ввели неправильный адрес в поле 'Кому'!";

$lang['snd_success'] = "Публикация \"%article%\" была успешно отправленная следующим адресатам:";


// =======================
// USERS

// Registration and user info

$lang['users'] = "Пользователи"; //"Пользователь"
$lang['user_box_txt'] = "Войти";
$lang['user_box_acc'] = "Моя страница";
$lang['user_login'] = "Логин";
$lang['user_important'] = "\\n Вы уверенны что хотите изменить ";
$lang['user_name'] = "Полное имя";
$lang['user_email'] = "Email";
$lang['user_card'] = "Номер карточки";
$lang['user_no_card'] = "Клубной карточки";
$lang['user_no_c1'] = "не имеет";
$lang['user_tel'] = "Номер телефона";
$lang['user_url'] = "Страница в Интернете";
$lang['user_pass0'] = "Старый пароль";
$lang['user_pass1'] = "Новый пароль";
$lang['user_pass'] = "Пароль";
$lang['user_pass2'] = "Повторите пароль";
$lang['user_hobby'] = "Специальность";
$lang['user_location'] = "Адрес";
$lang['user_study'] = "Место обучения";
$lang['user_birth'] = "Дата рождения";
$lang['user_icq'] = "ІCQ";
$lang['user_profile'] = "Личные данные";
$lang['user_me'] = "Обо мне";
$lang['user_vp'] = "Просмотреть фотографию";
$lang['user_cp'] = "Очистить фото";

$lang['user_total_posts'] = "Всего публикаций";
$lang['user_total_cmts'] = "Всего комментариев";
$lang['user_l_login'] = "Последний вход";

$lang['u'][0] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;---&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$lang['u'][1] = 'нет';
$lang['u'][2] = '1 курс';
$lang['u'][3] = '2 курс';
$lang['u'][4] = '3 курс';
$lang['u'][5] = '4 курс';
$lang['u'][6] = '5 курс';
$lang['u'][7] = '6 курс';
$lang['u'][8] = 'законченная';
$lang['u_max'] = 8;
$lang['u_info'] = 'Высшее образование';


$lang['user_reg_title'] = "Регистрация нового пользователя";
$lang['user_in'] = "Вход";
$lang['user_signup'] = "Зарегистрироваться";

$lang['user_reg_info'] = "Номер карточки";
$lang['user_reg'] = "Есть ли у Вас клубная карточка?";
$lang['user_reg_1'] = "У меня есть карточка";
$lang['user_reg_2'] = "У меня нет карточки";
$lang['user_reg_link'] = "Чтобы ознакомиться с условиями приобретения карточки, нажмите сюда";


$lang['user_blogs'] = "Страницы, которые пользователь может редактировать";
$lang['user_blogs1'] = "Страницы, которые Вы можете редактировать";
$lang['user_short_login'] = "Логин должен быть длиной от 3 до 10 символов";
$lang['user_short_pass'] = "Пароль слишком короткий! Минимум 5 символов";
$lang['user_card_no'] = "Номер карточки это пять или больше цифр!";
$lang['no_card_no'] = "Владелец карточки должен иметь номер карточки!";
$lang['card_no'] = "Несуществующая карточка!";
$lang['user_pass_nomatch'] = "Пароли не совпадают!";
$lang['user_pic'] = "Ваша фотография";
$lang['user_get_email'] = "Получать новости клуба по почте";
$lang['user_pic_show'] = "Показывать меня в \"пользователи на сайте\"";
$lang['pic_size_fail'] = "Максимальный размер файла %size% KB!";
$lang['exists'] = " не уникальный";
$lang['user_exists_msg'] = "Пользователь с такими данными уже зарегистрирован! ";
$lang['user_blog_no_sel'] = "Выберите страницу!";

$lang['reg_s_title'] = "Регистрация успешная!";
$lang['reg_s_msg'] = "Спасибо! Ваша персональная информация выслана Вам на електонну почту";

$lang['user_welcome_subject'] = "Благодарим за регистрацию!"; // New user welcome email subject
$lang['user_notify_subject'] = "Сообщение: Регистрация нового пользователя";
$lang['user_forgot_subject'] = "Возобновление пароля"; // Subject of the forgot password mail

$lang['user_no_accept'] = "Извините, на данный момент регистрация новых корнистувачiв отключена. Попробуйте зайти  через несколько дней.";


$lang['user_joined'] = "Присоединился к нам";
$lang['user_disp_id'] = "Отображать ";
$lang['user_disp_email'] = "Еmail видимый для всех";
$lang['user_disp_profile'] = "Не показывать никому Ваших данных";

// Login
$lang['logged'] = "Вы вошли как";
$lang['user_login_title'] = "Логин";
$lang['user_logout'] = "Выйти";
$lang['user_login_but'] = "Войти";
$lang['last_login'] = "Последний вход";
$lang['user_login_remember'] = "Помнить&nbsp;меня";
$lang['user_login_false'] = "Неправильный логин или пароль<br/> Проверьте раскладку клавиатуры";
$lang['user_cap_empty'] = "Нужно ввести код подтверждения!";
$lang['user_cap_false'] = "Вы ввели неправильный код";
$lang['user_cap'] = "Введите код, который изображено на рисунке";
$lang['forgot'] = "Пароль будет выслано на Ваш почтовый ящик";
$lang['user_forgot_pass'] = "Восстановить&nbsp;пароль";
$lang['user_forgot_but'] = "Получить мой пароль";
$lang['user_forgot_false'] = "Не найден пользователь с таким почтовым адресом";
$lang['user_frozen'] = "Вас отключил администратор!";
$lang['user_forgot_send_msg'] = "Вам присвоен новый пароль и отослано на Вашу почту!";

// Panel
$lang['user_mbr_title'] = "Страница пользователя";
$lang['user_welcome'] = "Добро пожаловать!";


$lang['user_level_info'] = "Ваш уровень";
$lang['user_level'][-1] = "Все";
$lang['user_level'][0] = "Отключенный";
$lang['user_level'][1] = "Зарегистрированный пользователь";
$lang['user_level'][2] = "Владелец карточки";
$lang['user_level'][3] = "Модератор";
$lang['user_level'][4] = "Администратор";

$lang['level_info'] = "Ваши возможности";
$lang['level_0'] = "нет";
$lang['level_1'] = "Получение новостей по почте";
$lang['level_2'] = "Просмотр закрытых страниц";
$lang['level_3'] = "Редактирование страниц";
$lang['level_4'] = "Контроль за пользователями";

$lang['user_post_new'] = "Новая публикация";
$lang['user_post_edit'] = "Редактировать публикации";
$lang['user_post_list'] = "Список публикаций";
$lang['user_acc'] = "Мои личные данные";


$lang['user_new_title'] = "Написать новую публикацию";
$lang['user_pass_need'] = "Изменить пароль";


// File manager
$lang['file_title'] = "Загрузить файлы";
$lang['file_fl'] = " Файл ";
$lang['file_but'] = " Загрузить ";


// =======================
// Date / Calendar (3.1)

$lang['caln_tip'] = "Опубликовано";
$lang['caln_next'] = "Следующий месяц";
$lang['caln_prev'] = "Предыдущий месяц";


$lang['c'][0] = 'все';
$lang['c'][1] = 'лишь зарегистрированные пользователи';
$lang['c'][2] = 'лишь владельцы карточки';
$lang['c'][3] = 'лишь модераторы';
$lang['c']['info'] = 'Информацию могут видеть %x%';
$lang['c']['info1'] = 'Эту публикацию могут видеть ';
$lang['c']['info2'] = "Регистрация на сайте и приобретение карты дает возможность видеть скрытую информацию";


// Full Weekdays
$lang['date']['Sunday'] = 'Воскресенье';
$lang['date']['Monday'] = 'Понедельник';
$lang['date']['Tuesday'] = 'Вторник';
$lang['date']['Wednesday'] = 'Среда';
$lang['date']['Thursday'] = 'Четверг';
$lang['date']['Friday'] = 'Пятница';
$lang['date']['Saturday'] = 'Суббота';

// Weekdays Abbrivated
$lang['date']['Sun'] = 'Вос';
$lang['date']['Mon'] = 'Пон';
$lang['date']['Tue'] = 'Втр';
$lang['date']['Wed'] = 'Срд';
$lang['date']['Thu'] = 'Чтв';
$lang['date']['Fri'] = 'Пят';
$lang['date']['Sat'] = 'Суб';

// Weekdays even shorter :)
$lang['date']['week_day_1'] = 'Н';
$lang['date']['week_day_2'] = 'П';
$lang['date']['week_day_3'] = 'В';
$lang['date']['week_day_4'] = 'С';
$lang['date']['week_day_5'] = 'Ч';
$lang['date']['week_day_6'] = 'П';
$lang['date']['week_day_7'] = 'С';

// Months
$lang['d1']['January'] = 'Январь';
$lang['d1']['February'] = 'Февраль';
$lang['d1']['March'] = 'Март';
$lang['d1']['April'] = 'Апрель';
$lang['d1']['May'] = 'Май';
$lang['d1']['June'] = 'Июнь';
$lang['d1']['July'] = 'Июль';
$lang['d1']['August'] = 'Август';
$lang['d1']['September'] = 'Сентябрь';
$lang['d1']['October'] = 'Октябрь';
$lang['d1']['November'] = 'Ноябрь';
$lang['d1']['December'] = 'Декабрь';

$lang['date']['January'] = 'Января';
$lang['date']['February'] = 'Февраля';
$lang['date']['March'] = 'Марта';
$lang['date']['April'] = 'Апреля';
$lang['date']['May'] = 'Мая';
$lang['date']['June'] = 'Июня';
$lang['date']['July'] = 'Июля';
$lang['date']['August'] = 'Августа';
$lang['date']['September'] = 'Сентября';
$lang['date']['October'] = 'Октября';
$lang['date']['November'] = 'Ноября';
$lang['date']['December'] = 'Декабря';

// Months abbrivated
$lang['date']['Jan'] = 'Янв';
$lang['date']['Feb'] = 'Фев';
$lang['date']['Mar'] = 'Мар';
$lang['date']['Apr'] = 'Апр';
$lang['date']['May'] = 'Мая';
$lang['date']['Jun'] = 'Июн';
$lang['date']['Jul'] = 'Июл';
$lang['date']['Aug'] = 'Авг';
$lang['date']['Sep'] = 'Сен';
$lang['date']['Oct'] = 'Окт';
$lang['date']['Nov'] = 'Ноя';
$lang['date']['Dec'] = 'Дек';


// =======================
// Search

$lang['rel'] = "Релевантность";
$lang['search_in'] = "Поиск по";
$lang['search_all'] = "Всему";
$lang['search_title'] = "Заголовку";
$lang['search_content'] = "Тексту";
$lang['search_author'] = "Имени автора";
$lang['search_reslut_msg'] = "Результаты поиска для %key%";
$lang['search_resut_no'] = "По этому запросу ничего не найдено";
$lang['search_key'] = "Слишком короткое слово! Минимум четыре символа!";
$lang['admin_search_results'] = "%num% результатов";
$lang['pages_show'] = "На страницах&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";


// =======================
//By time description
$lang['admin_post_show'] = "Дата последнего изменения";
$lang['admin_post_week'] = "Этой недели";
$lang['admin_post_month'] = "Этого месяца";
$lang['admin_post_last_month'] = "Месяц назад";
$lang['admin_post_last_6month'] = "2-12 месяцев назад";
$lang['admin_post_last_year'] = "Больше года назад";
$lang['admin_del_chk'] = "Инвертировать выделение";

//no_discount
$lang['no_discount'] = "Мне не дали скидку";
$lang['no_discount_0'] = "Кто не дал скидку?";
$lang['no_discount_tip'] = "Не дали скидку?<br/> Напиши об этом нам!";
$lang['no_discount_1'] = "Организация";
$lang['no_discount_2'] = "Менеджер или кассир";
$lang['no_discount_3'] = "Причина отказа";
$lang['no_discount_4'] = "Ваши контакты";
$lang['no_discount_4a'] = "Ваш номер карточки";
$lang['no_discount_5'] = "Ваша жалоба успешно отправлена";


// =======================
// General Error messages

$lang['error_cookie'] = "Сookies должны быть включены. Возможно, кто-то еще залогировался под вашим именем";
$lang['error_no_title1'] = "Вы не ввели заголовок ";
$lang['error_no_numeric'] = "Нужно ввести число ";
//$lang['error_no_src1']="Вы не заполнили поле короткой новости!";
$lang['empty_fields'] = "Вы не заполнили все поля. Проверьте еще раз";
$lang['incorrect_email'] = "Вы ввели неправильный e-mail адрес";
$lang['denied'] = "Доступ запрещен!";
$lang['err_write'] = "Папка закрыта для записи";
$lang['no_file'] = "Не могу прочитать файл";
$lang['no_img'] = "Не могу загрузить изображение";
$lang['closed_blog'] = "Эта страница закрыта для просмотра";
$lang['post_no_access'] = "У Вас нет доступа к этой публикации";
$lang['post_no_mod'] = "Вы не имеете прав для редактирования этой публикации";
//$lang['post_no_area']="У Вас нет доступа к пользоваиельскому меню";

$lang['no_id'] = "Не найдена такая публикация";
$lang['no_user'] = "Не найден такой пользователь";
$lang['no_archive'] = "Не найдены публикации за этот месяц: %date%";
$lang['no_blog'] = "Заданная страница не найдена";
$lang['no_data_avail'] = " Ничего не найдено =(";
$lang['no_cat'] = "Нет такой подкатегории";
$lang['banned'] = "Вас отключил администратор";
$lang['profiles_no_pub'] = "Пользователь не захотел публиковать свои данные";
$lang['blog_frozen'] = "Эта страница только для владельцев карточки";
//$lang['user_frozen']="Этот пользователь закрыт администратором";
$lang['rss_no_blog'] = "Cannot generate RSS feed! The page you requested doesn't exist!";


//Subcats
$lang['subcats'] = "Подкатегории";
$lang['subcat'] = "Подкатегоря";
$lang['subcat_change'] = "Изменить подкатегорию";
$lang['subcat_change_confirm'] = "Вы действительно желаете изменить пiдкатегорiю?\\n(вместе с ней может быть измененная страница)";
$lang['subcat_del_post'] = "Вместе с публикациями";
$lang['subcat_del_confirm'] = "Вы в самом деле хотите удалить подкатегорию?";
$lang['subcat_empty'] = "Выберите подкатегорию со списка?";
$lang['subcat_post_del_confirm'] = "Вы хотите удалить публикации из подкатегории?";
$lang['subcat_selected'] = "Выделите подкатегории, которые будут отображаться на этой странице";


// ADMІ

//if(! ІN_ADMІ) break;
$lang['admin'] = "Администратор";
$lang['neither'] = " --- нет --- ";
/////////////////////////////////////////////////////////////////////////
// =======================


$lang['admin_del_sel_but'] = "УНИЧТОЖИТЬ ВЫДЕЛЕННЫЕ";
$lang['admin_sel_h'] = "Выделить скрытые";
$lang['admin_sel_d'] = "Выделить черновики";
$lang['admin_sel_s'] = "Выделить мои публикации";
// General2


$lang['sort'] = "Сортировать";
$lang['stat'] = "Статистика - new";
$lang['stat_click'] = " Всего кликов на публикацию";


$lang['ppage'] = "Отображать";
$lang['level'] = "Уровень";
$lang['users_online'] = "Пользователи на сайте"; // (3.1)
$lang['geo_ip'] = "Посмотреть, где расположен пользователь на карте";
$lang['save_js'] = "Это окно должно закрытся автоматически при включенном JavaScript. Если нет, закройте его самостоятельно пожалуста." //Success. The window should close automatically if JavaScript enabled.
//If it doesn't, please close it manually
?>
