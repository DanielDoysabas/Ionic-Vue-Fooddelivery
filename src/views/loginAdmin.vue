<template lang="">
    <ion-content>
        <ion-page>
            <div class="container">
                <div class="x-img">
                    <h3>ADMIN PORTAL</h3>
                </div>
                <div class="x-img">
                    <ion-img src="assets/icon/logo.png" alt="The Wisconsin State Capitol building in Madison, WI at night"></ion-img>
                </div>
                <div class="form-group">
                    <ion-input class="form_input" v-model="username" placeholder="username"></ion-input>
                </div>
                <div class="form-group">
                    <ion-input class="form_input" v-model="password" placeholder="password" type="password"></ion-input>
                </div>
                <div class="form-group">
                    <ion-button @click ="Login">Login</ion-button>
                </div>
            </div>
        </ion-page>
    </ion-content>
</template>
<script lang="ts">
    import { IonButton,IonInput } from '@ionic/vue';
    import { defineComponent } from 'vue';
    import axios from 'axios';

    export default defineComponent({
        name: 'test',
        components:{
            IonButton,IonInput
        },
        data() {
            return {
                users: null,
                username:null,
                password:null
            }
        },mounted(){
            this.CheckSession();
        },
        methods: {
            CheckSession(){
                if(localStorage.getItem('id') === null){
                    console.log("false");
                    this.$router.push("/login_admin");
                }else{
                    console.log("true");
                    this.$router.push("/admin_dashboard");
                }
            },
            Login(){
                axios.post('http://localhost:80/api/login.php',null,{
                    params:{
                        "username":this.username,
                        "password":this.password,
                        "type":2,
                    }
                })
                .then((response) => {
                    if(response.data.status==1){
                        localStorage.id = response.data.id;
                        this.$router.push("/admin_dashboard");
                    }else{
                        const a = response.data.message;
                        if(a!=null){
                            alert(a);
                        }else{
                            alert("No User Found")
                        }
                    }
                }).catch(
                    function(e){
                        console.log("SQL Query Issue");
                    }
                );
            },
        }
    })
    
</script>
<style scoped>

ion-page{
    background: #fff;
    height: 100vh;
    margin:0 auto;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
}

ion-page .container{
    display: flex;
    flex-direction: column;
    gap:1.5rem;
}

ion-button{
    width: 100%;
}

ion-button:hover{
    box-shadow: 0 10px 36px rgba(0, 0, 0, .15);
}

ion-img{
    width: 200px;
    height: auto;
}

.x-img{
    display: flex;
    align-items: center;
    justify-content: center;
}

.form-group{
    position: relative;
    height: 48px;
}

.form_input{
    color: #5340ff !important;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 1px solid #5340ff;
    padding: 1rem !important;
    border-radius: .5rem;
    outline: none;
    background: none;
    z-index: 1;
    font-size: 0.75rem;
}

h3{
    color: #5340ff;
}

</style>