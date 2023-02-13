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
        <ion-title>ORDER LIST</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content class="ion-padding">
        <div class="order-list"  v-bind:class="{hidden:isActiveOrderList}">
              <ion-accordion-group >
                      <ion-accordion v-for = "food in foods" :key="food" class="x-card" @click ="ExpandData(food)" >
                        <ion-item slot="header" color="light">
                          <ion-label>Order: {{ food.transaction_number }}</ion-label>
                          <p>Total : ₱ {{ food.totalprice }}</p>
                        </ion-item>
                        <div class="ion-padding" slot="content">
                          <h4>USER: {{ user }}</h4>
                          <ion-list v-for = "data_purchase in activity_purchase" :key="data_purchase">
                            <ion-item>
                              <ion-label>{{ data_purchase.foodname }}</ion-label>
                              <p>₱ {{ data_purchase.price }}</p>
                            </ion-item>
                          </ion-list>
                          <ion-button @click ="presentAlert(food.id)">Confirm Order</ion-button>
                        </div>
                      </ion-accordion>
              </ion-accordion-group>
          <div class="x-tools  form-group">
          </div>
        </div>  
        <div class="confirm-order">

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
      IonList,
      IonItem,
      IonToolbar,
      toastController
    } from '@ionic/vue';
    import { defineComponent } from 'vue';
    import axios from 'axios';
    import { ref } from 'vue';
    import { IonButton, alertController } from '@ionic/vue';
import { Alert } from '@ionic/core/dist/types/components/alert/alert';

    export default defineComponent({
      components: {
        IonButtons,
        IonContent,
        IonHeader,
        IonMenu,
        IonMenuButton,
        IonPage,
        IonTitle,
        IonToolbar,
      },data() {
        return {
                order1:[
                  {
                    ids:null,
                    name:null,
                    price:null,
                    userid:null,
                  }
                ],
                foods:[],
                isActiveOrderList:false,
                activity_purchase:[],
                data_activity:[],
                user:null,
                order_userid:null,
                userid:localStorage.getItem("id"),
      }
    },mounted(){
            this.loadOrder();
    },methods: {

     async presentAlert(id:any){
        const handlerMessage = ref('');
        const roleMessage = ref('');
        
          const alert = await alertController.create({
            header: 'Confirm the order to completed ?!',
            buttons: [
              {
                text: 'Cancel',
                role: 'cancel',
                handler: () => {
                  handlerMessage.value = 'Alert canceled';
                },
              },
              {
                text: 'OK',
                role: 'confirm',
                handler: () => {
                  axios.post('http://localhost:80/api/adminOrders.php',null,{
                        params:{
                            "id":id,
                        }
                  })
                  .then((response) => {
                    if(response.data.status==1){
                      this.showToastMessage();
                      window.location.reload();
                    }
                  });
                },
              },
            ],
          });
  
          await alert.present();
  
          const { role } = await alert.onDidDismiss();
          roleMessage.value = `Dismissed with role: ${role}`;
          
          return {
            handlerMessage,
            roleMessage
          };
      },

      async showToastMessage(){
          const toast = await toastController.create(
          {
            message:"Your Order is Complete!"
          }
          );
          return toast.present();
      } ,

      ExpandData(data:any){
          if(data!=null){
            const a = data.orderlist;
            this.activity_purchase = JSON.parse(a as string);
            const id = this.activity_purchase[0];
            axios.post('http://localhost:80/api/getUser.php',null,{
                      params:{
                          "id":id["id"],
                      }
            })
            .then((response) => {
                this.user = response.data[0].username;
                this.order_userid = response.data[0].id;
            });
          }
        },
      loadOrder(){
        axios.get('http://localhost:80/api/orderList.php')
        .then((response) => {
            this.foods = response.data;
        });
      },
      Logout(){
          localStorage.clear();
      },
      CheckSession(){
          if(localStorage.getItem('id') === null){
              this.$router.push("/login");
          }
      },
    },
    });

  </script>
  
  <style>
  h2{
    color: #5340ff !important;
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
  </style>