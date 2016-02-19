<div class="thaydoithongtin">
    <div class="thaydoithongtinform">
    <form action="/site/update-user" method="post">
        <label class="control-label" >Họ và tên </label> 
        <input  class="form-control" type="text" name="user[first_name]" value="<?=$model['first_name']?>"><br>
        <input  class="form-control" type="text" name="user[last_name]" value="<?=$model['last_name']?>"><br>
        <label class="control-label" > Số điện thoại </label> 
        <input class="form-control" type="text" name="user[phone_number]" value="<?=$model['phone_number']?>"><br>
        <label class="control-label" >Địa chỉ Email </label>  
        <input class="form-control" type="email" name="user[email]" value="<?=$model['email']?>"><br>
        <button type="submit" class="btn btn-primary">Thực hiện thay đổi</button>
    </form>
    </div>
</div>