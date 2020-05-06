<template>
    <div>
        <button @click="getCode" style="width: 112px;height:60px;border:0; float: right">{{getCodeText}}</button>
        <p>{{username}}</p>
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
    props: [
        "msg",
        "username",
    ],
    mounted: function() {
		this.$nextTick(function() {
            console.log(this.username)
        })
		
		
	},
    methods: {
        getCode(){
            
            var _this = this;
            var timer = null;
            var s = 60;
            
            var regEmail = /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/;
            if(this.username.match(regEmail)){
               
                return false;
            }
            if(_this.username == ''){
                // _this.$message({
                //     message: '请输入邮箱',
                //     type: 'error'
                // });
                return false;
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

            }
            
        },
    }
}
</script>