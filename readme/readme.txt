新的接口请用Rest Client进行测试，请求头部的验证已关闭

请求URL							请求方式
http://localhost/yii-rest/index.php/user/list		GET
http://localhost/yii-rest/index.php/user/create		POST
http://localhost/yii-rest/index.php/user/view/1		GET
http://localhost/yii-rest/index.php/user/update/1	PUT
http://localhost/yii-rest/index.php/user/delete/1	DELETE

在配置了伪静态后可去除请求url中的"index.php"进行测试

测试用例新增用户请求Body内容

{"user_name":"fff","user_type":"6","email":"test@gmail.com","password":"123456","password_salt":"1","group_id":"1"}