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
      <div class="foodlist" v-bind:class="{hidden:isActiveFoodList}">
        <ion-list>
              <ion-radio-group value="">
                  <ion-item v-for = "food in foods" :key="food">
                      <ion-label>{{ food.foodname }}</ion-label>
                      <p>₱ {{ food.price }}</p>
                      <div class="tools-action">
                        <ion-button @click ="Delete(food.id)" class="btn" >
                           DELETE
                        </ion-button>
                        <ion-button class="btn" @click ="Edit(food.id,food.foodname,food.price)">
                            EDIT
                        </ion-button>
                      </div>
                  </ion-item>
                </ion-radio-group>
            </ion-list>
      </div>
      <div class="edit-food" v-bind:class="{hidden:isActiveEditFood}">
            <div class="form-group hidden">
                  <ion-input  class="form_input" v-model="foodid" placeholder="foodid" type="text"></ion-input>
              </div>
            <div class="form-group">
                  <ion-input class="form_input" v-model="foodname" placeholder="foodname" type="text"></ion-input>
              </div>
              <div class="form-group">
                  <ion-input class="form_input" v-model="price" placeholder="price" type="text"></ion-input>
              </div>
              <div class="form-group">
                  <ion-button @click ="SaveFood">Save Food</ion-button>
                  <ion-button @click ="Back">Back</ion-button>
              </div>
      </div>
    </ion-content>
  </ion-page>
</template>
  
  <script lang="ts">
    import {
      IonButtons,
      IonContent,
      IonHeader,
      IonMenu,
      IonMenuButton,
      IonPage,
      IonTitle,
      IonInput,
      IonList,
      IonItem,
      IonToolbar,
      toastController
    } from '@ionic/vue';
    import { defineComponent } from 'vue';
    import axios from 'axios';
import { Alert } from '@ionic/core/dist/types/components/alert/alert';

    export default defineComponent({
      components: {
        IonButtons,
        IonContent,
        IonHeader,
        IonMenu,
        IonMenuButton,
        IonInput,
        IonPage,
        IonTitle,
        IonToolbar,
      }, data() {
            return {
                foods:[],
                userid:localStorage.getItem("id"),
                foodname:null,
                price:null,
                foodid:null,
                isActiveFoodList:false,
                isActiveEditFood:true
            }
        },mounted(){
          this.loadFoods();
          this.CheckSession();
        },
        methods: {
             async showToastMessage(){
               const toast = await toastController.create(
                {
                  message:"Your Order is Complete!"
                }
               );
                return toast.present();
              }
            ,
            loadFoods(){ 
                axios.get('http://localhost:80/api/foods.php')
                .then((response) => {
                    this.foods = response.data;
                });
            },
             Logout(){
                localStorage.clear();
              },
            CheckSession(){
              if(localStorage.getItem('id') === null){
                console.log("false");
                this.$router.push("/login_admin");
              } 
            },
            Delete(id:any){
              axios.post('http://localhost:80/api/deletefood.php',null,{
                    params:{
                      "id":id,
                    }
                })
                .then((response) => {
                  alert(response.data.message);
                  window.location.reload();
                });
            },
            Edit(foodid:any,foodname:any,price:any){
              this.isActiveFoodList = true;
              this.isActiveEditFood = false;
              this.foodname = foodname;
              this.price = price;
              this.foodid = foodid;
              console.log( this.foodname );
            },
            SaveFood(){
              axios.post('http://localhost:80/api/updatefood.php',null,{
                    params:{
                      "id":this.foodid,
                      "price":this.price,
                      "foodname":this.foodname,
                    }
              })
              .then((response) => {
                alert(response.data.message);
                window.location.reload();
              });
            }
        }
    });
  </script>
  
  <style>
  .hidden{
    display: none;
  }
  ion-radio-group{
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    gap: 1rem;
  }
  .tools-action{
    margin-left: 1rem;
  }
  .btn {
    font-size: 0.75em;
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
 
  ion-button{
    width: 100%;
  }
  </style>