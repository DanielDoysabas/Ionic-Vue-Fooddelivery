<template>
  <ion-menu content-id="main-content">
    <ion-header>
      <ion-toolbar>
        <ion-title>Menu</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content class="ion-padding">
      <ion-list>
        <ion-item href="./admin_dashboard" class="link-x">
          <ion-label>Home</ion-label>
        </ion-item>
        <ion-item href="./admin_food" class="link-x">
          <ion-label>Food Manager</ion-label>
        </ion-item>
        <ion-item href="./admin_beverage" class="link-x">
          <ion-label>Beverages Manager</ion-label>
        </ion-item>
        <ion-item href="./admin_order" class="link-x">
          <ion-label>OrderList Manager</ion-label>
        </ion-item>
        <ion-item href="./login_admin" @click ="Logout" class="link-x">
          <ion-label>Logout</ion-label>
        </ion-item>
      </ion-list>
    </ion-content>
  </ion-menu>
  <ion-page id="main-content">
    <ion-header>
      <ion-toolbar>
        <ion-buttons slot="start">
          <ion-menu-button></ion-menu-button>
        </ion-buttons>
        <ion-title>FOODS MANAGE</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content class="ion-padding">
      <ion-page>
            <div class="container">
                <div class="form-group">
                    <ion-input class="form_input" v-model="foodname" placeholder="foodname" type="text"></ion-input>
                </div>
                <div class="form-group">
                    <ion-input class="form_input" v-model="price" placeholder="price" type="text"></ion-input>
                </div>
                <div class="form-group">
                  <ion-item>
                    <ion-label>FOOD</ion-label>
                  </ion-item>
                </div>
                <div class="form-group">
                    <ion-button @click ="SaveFood">Save Food</ion-button>
                    <ion-button @click ="Back">Back</ion-button>
                </div>
            </div>
        </ion-page>
    </ion-content>
  </ion-page>
</template>
  
  <script lang="ts">
    import {
      IonInput,
      IonButtons,
      IonContent,
      IonHeader,
      IonMenu,
      IonMenuButton,
      IonPage,
      IonTitle,
      IonList,
      IonItem,
      IonToolbar,
      toastController
    } from '@ionic/vue';
    import { defineComponent } from 'vue';
    import axios from 'axios';

    export default defineComponent({
      components: {
        IonInput,
        IonButtons,
        IonContent,
        IonHeader,
        IonMenu,
        IonMenuButton,
        IonPage,
        IonTitle,
        IonToolbar,
      }, data() {
            return {
                foodname:null,
                price:null,
                foodtype:1,
                userid:localStorage.getItem("id")
            }
            }, mounted(){
              this.CheckSession();
            },methods: {
             async showToastMessage(){
               const toast = await toastController.create(
                {
                  message:"Food Update Successfully!"
                }
               );
                return toast.present();
            },
            Back(){
              this.$router.push("/admin_food");
             },
            SaveFood(){
                  axios.post('http://localhost:80/api/adminFoods.php',null,{
                    params:{
                      "foodname":this.foodname,
                      "price":this.price,
                      "foodtype":this.foodtype,
                    }
                  })
                  .then((response) => {
                    if(response.data.status==1){
                      this.showToastMessage();
                    }
                  });     
             },
             Logout(){
                localStorage.clear();
              },
            CheckSession(){
              if(localStorage.getItem('id') === null){
                this.$router.push("/login_admin");
              } 
            },
        }
    });
  </script>
  
  <style>
  .container{
    padding-inline: 1rem;
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1rem;
    min-height: 100vh;
  }

  .form-group{
    position: relative;
    height: 48px;
}

  .link-x{
    cursor: pointer;
  }
  .hidden{
    display: none;
  }
  .listpurchase-footer{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
  }
  .orderList{
    min-height: 100vh;
    position: relative;
  }
  .x-tools{
    position: absolute;
    width: 100%;
    bottom: 40px;
  }
  ion-button{
    width: 100%;
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
    outline: none;
    background: none;
    z-index: 1;
    font-size: 1.25rem;
}

  </style>