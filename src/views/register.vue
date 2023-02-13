<template lang="">
    <ion-content>
        <ion-page>
            <div class="container">
                <div class="form-group">
                    <ion-label>Username</ion-label>
                    <ion-input v-model="username" placeholder="Username"></ion-input>
                </div>
                <div class="form-group">
                    <ion-label>Password</ion-label>
                    <ion-input v-model="password" placeholder="Password" type="password"></ion-input>
                </div>
                <div class="form-group">
                    <ion-label>Confirm Password</ion-label>
                    <ion-input v-model="cpassword" placeholder="Confirm Password" type="password"></ion-input>
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
                            "username":this.username,
                            "password":this.password
                        }
                    })
                    .then((response) => {
                        console.log(response.data);
                    });
                }else{
                    alert("Password and Confirm Password not Match")
                }
            }
        }
    })
    
</script>
<style scoped>
</style>