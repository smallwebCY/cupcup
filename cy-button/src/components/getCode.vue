<template>
    <!-- <el-button  style="width: 112px; float: right" type="primary" @click="getCode">{{getCodeText}}</el-button> -->
    <div>
        <button style="width: 112px;height:60px;border:0; float: right">{{getCodeText}}</button>
    </div>
</template>
<script>
export default {
    name: 'getCode',
    data(){
        return{
            getCodeText: '获取验证码',
            isOver: false,
        }
    },
    props: ['username','codetype'],
    methods: {
        getCode(){
            console.log(this.codetype)
            var _this = this;
            var timer = null;
            var s = 60;
            var regEmail = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
            if(_this.username == ''){
                _this.$message({
                    message: '请输入邮箱',
                    type: 'error'
                });
                return;
            }
            if(!regEmail.test(_this.username)){
                _this.$message({
                    message: '请输入正确的邮箱',
                    type: 'error'
                });
                return;
            }
            if(!this.isOver){
                this.isOver = true;
                this.getCodeText = s + 's';
                timer = setInterval(() => {
                    s--;
                    if(s < 1){
                        this.isOver = false;
                        this.getCodeText = '重新发送';  
                        clearInterval(timer);
                        timer = null;
                        s = 60;
                        return;
                    }
                    _this.getCodeText = s + 's';  
                }, 1000)

                _this.$store.dispatch('login/sendcode', {username: _this.username, type: _this.codetype}).then(res => {
                    if(res['code'] == 0){
                        _this.$message({
                            message: res['msg'],
                            type: 'success'
                        })
                    }else{
                        _this.$message({
                            message: res['msg'],
                            type: 'error'
                        })
                    }
                })
            }
            
        },
    }
}
</script>