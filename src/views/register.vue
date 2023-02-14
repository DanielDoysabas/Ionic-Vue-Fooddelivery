<template lang="">
    <ion-content>
        <ion-page>
            <div class="container">
                <div class="header">
                    <h1>Register</h1>
                </div>
                <div class="form-group">
                    <ion-label>Name</ion-label>
                    <ion-input class="form_input" v-model="name" placeholder="Name"></ion-input>
                </div>
                <div class="form-group">
                    <ion-label>Username</ion-label>
                    <ion-input class="form_input" v-model="username" placeholder="Username"></ion-input>
                </div>
                <div class="form-group">
                    <ion-label>Password</ion-label>
                    <ion-input class="form_input" v-model="password" placeholder="Password" type="password"></ion-input>
                </div>
                <div class="form-group">
                    <ion-label>Confirm Password</ion-label>
                    <ion-input class="form_input" v-model="cpassword" placeholder="Confirm Password" type="password"></ion-input>
                </div>
                <div class="form-group">
                    <ion-button @click ="Register">Register</ion-button>
                </div>

                <div class="form-group">
                    <div id="test" name="test">
                        <!-- {{users}} -->
                    </div>
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
                name: null,
                users: null,
                username:null,
                password:null,
                cpassword:null
            }
        },mounted(){
            this.CheckSession();
        },
        methods: {
            CheckSession(){
                if(localStorage.getItem('id') === null){
                    console.log("false");
                    this.$router.push("/login");
                }else{
                    console.log("true");
                    this.$router.push("/home");
                }
            },
            Register(){
                if(this.password==this.cpassword){
                    axios.post('http://localhost:80/api/register.php',null,{
                        params:{
                            "name":this.name,
                            "username":this.username,
                            "password":this.password
                        }
                    })
                    .then((response) => {
                        console.log(response.data);
                        if(response.data.status==1){
                            alert(response.data.message);
                            this.$router.push("/login");
                            window.location.reload();
                        }
                    });
                }else{
                    alert("Password and Confirm Password not Match")
                }
            }
        }
    })
    
</script>
<style scoped>
h1{
    color: #5340ff !important;
    text-align: center;
}
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

.x-img{
    display: flex;
    align-items: center;
    justify-content: center;
}

.form-group{
    width: 300px;
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

</style>