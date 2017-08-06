#创建管理员表

create table bg_admin(
	admin_id tinyint unsigned primary key auto_increment,
	admin_name varchar(20) not null unique key,
	admin_pass char(32) not null,
	login_ip varchar(30) not null,
	login_nums int unsigned default 0,
	login_time int unsigned
);

insert into bg_admin values (null,'litao',md5('12345678'),'127.0.0.1',0,unix_timestamp());

create table category(
cate_id smallint unsigned unsigned primary key auto_increment,
cate_name varchar(20) not null,
cate_pid smallint not null 
);

insert into category values
	(1,'家用电器',0),
	(2,'电视',1),
	(3,'空调',1),
	(4,'冰箱',1),
	(5,'合资品牌',2),
	(6,'国产品牌',2),
	(7,'互联网品牌',2),
	(8,'多门',4),
	(9,'单门',4),
	(10,'电脑',0),
	(11,'电脑配件',10),
	(12,'主板',11),
	(13,'国产主板',12),
	(14,'进口主板',12);


create table bg_category(
	cate_id smallint unsigned primary key auto_increment,
	cate_name varchar(20) not null,
	cate_pid smallint not null,
	cate_sort smallint not null,
	cate_desc varchar(255) 
);

insert into bg_category values 
	(1,'慢生活',0,0,'慢生活有益健康'),
	(2,'日记',1,0,'慢生活有益健康'),
	(3,'欣赏',1,1,'请大家欣赏一下我的点点滴滴'),
	(4,'程序人生',1,2,'程序人生很苦逼'),
	(5,'经典语录',1,3,'哥的经典语录'),
	(6,'PHP课堂',0,0,'PHP是世界上最好的语言'),
	(7,'HTML',6,0,'基础班学习的第一个知识点');

create table bg_article(
	art_id smallint unsigned primary key auto_increment,
	cate_id smallint unsigned not null comment '文章所属分类',
	title varchar(50) not null,
	thumb varchar(100) comment '缩略图',
	art_desc text,
	content text,
	author varchar(20),
	hits smallint unsigned not null default 99,
	addtime int unsigned not null comment '文章发表时间',
	is_del enum('0','1') not null default '0' comment '是否逻辑删除'
);

alter table bg_article add is_recommend enum('0','1') not null default '0' after addtime;

#创建站长信息表
create table bg_master (
	id tinyint primary key auto_increment,
	nickname varchar(20) not null,
	job varchar(50) not null,
	home char(11) not null,
	tel char(11) not null,
	email varchar(50) not null
);

--插入体验数据
insert into bg_master values(null,'Dalin|~~~','猿类','电脑前','13712345678','liqq@qq.com');

create table bg_singlePage(
	page_id tinyint unsigned primary key auto_increment,
	title varchar(50) not null,
	content text
);
insert into bg_singlePage values
	(null,'about us','我们来自传智播客广州校区PHP24期');