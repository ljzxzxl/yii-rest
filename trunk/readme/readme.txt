新的接口请用Rest Client进行测试，请求头部的验证已关闭

请求URL							请求方式
http://localhost/yii-rest/index.php/user/list		GET
http://localhost/yii-rest/index.php/user/create		POST
http://localhost/yii-rest/index.php/user/view/1		GET
http://localhost/yii-rest/index.php/user/update/1	PUT
http://localhost/yii-rest/index.php/user/delete/1	DELETE

在配置了伪静态后可去除请求url中的"index.php"进行测试

测试用例新增用户请求Body内容

{"user_name":"admin","user_type":"1","email":"ljzxzxl@gmail.com","password":"123456","group_id":"1"}
{"user_name":"test1","user_type":"1","email":"test1@gmail.com","password":"123456","group_id":"1"}
{"user_name":"test2","user_type":"1","email":"test2@gmail.com","password":"123456","group_id":"1"}

{"order_status":"checked","order_date":"1364379828","email":"ljzxzxl@gmail.com","password":"123456","group_id":"1"}


{"company_name":"测试公司名二","company_type":"1","company_address":"上海市嘉定区","company_phone":"021-64694684","company_status":"0","create_date":"1364892750","last_update_date":"1364892750","last_update_uid":"1364892750"}

{"file_name":"测试文件名二","path":"D:\\www\\htdocs\\yii-rest\\readme","folder_id":"1","owner_uid":"1","size":"1024","create_date":"1364894003","update_date":"1364894003","mime_type":"1364894003","hash":"DODESTCOLUMNE","create_uid":"1","create_uname":"admin"}

{"folder_name":"测试文件夹二","parent_id":"1","path":"D:\\\\www\\\\htdocs\\\\yii-rest\\\\readme"}

{"group_name":"测试组名二","group_desc":"\u6d4b\u8bd5\u7ec4\u8bf4\u660e\u6587\u5b57"}

{"order_name":"测试订单二","order_status":"no","create_date":"1364379828"}

{"pref_key":"login","pref_name":"偏好设置名二","pref_value":"true","user_id":"1"}

{"share_name":"测试分享二","file_id":"1","folder_id":"1","share_type":"0","owner_uid":"1","permission":"1","share_date":"1364895640","expiration":null,"token":null,"download_date":"1364895640","download_nums":"20","share_link":"http:\/\/t.cn\/zT2UoOP"}

{"workspace_name":"测试工作空间二","workspace_desc":"\u6d4b\u8bd5\u63cf\u8ff0\u6587\u5b57"}