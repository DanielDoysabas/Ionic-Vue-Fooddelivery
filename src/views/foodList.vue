<template>
  <ion-menu content-id="main-content">
    <ion-header>
      <ion-toolbar>
        <ion-title>Menu</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content class="ion-padding">
      <ion-list>
        <ion-item href="./home" class="link-x">
          <ion-label>Home</ion-label>
        </ion-item>
        <ion-item href="./foodlist" class="link-x">
          <ion-label>Food</ion-label>
        </ion-item>
        <ion-item href="./beveragelist" class="link-x">
          <ion-label>Beverages</ion-label>
        </ion-item>
        <ion-item href="./login" @click ="Logout" class="link-x">
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
        <ion-title>FOODS AVAILABLE</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content class="ion-padding">
      <div class="orderList" v-bind:class="{hidden:isActiveOrderList}">
        <ion-list>
            <ion-radio-group >
              <ion-item v-for = "food in foods" :key="food">
                <ion-checkbox slot="start" @click ="addorder(food.id,food.price,food.foodname)"></ion-checkbox>
                <IonAvatar slot="start">
                  <ion-img src ='assets/upload/img/4-2-food-png-thumb.png' class="img-static">
                  </ion-img>
                </IonAvatar>
                <ion-label>{{ food.foodname }}</ion-label>
                <p>₱ {{ food.price }}</p>
                </ion-item>
              </ion-radio-group>
            </ion-list>
          <div class="x-tools  form-group">
              <ion-button @click ="Continue">Add Order</ion-button>
          </div>
      </div>
      <div class="listpurchase" v-bind:class="{hidden:isActivePurchaseList}">
        <h2>Order List</h2>
        <div class="listpurchase-body">
          <ion-list>
            <!-- <ion-item v-for = "(order, i) in order1" :key="i"> -->
            <ion-item v-for = "order in order1" :key="order">
                    <ion-label>
                      {{ order.name }}
                    </ion-label>
                    <p>
                      ₱ {{ order.price }}
                    </p>
            </ion-item>
          </ion-list>
        </div>
        <div class="listpurchase-footer">
            <h3>Total Price</h3>
            <h3>₱ {{ totalprice  }}</h3>
        </div>
        <div class="action">
          <ion-button @click ="Order">
            Order
          </ion-button>
        </div>
      </div>
      <div class="payment-transaction" v-bind:class="{hidden:isActiveTransaction}"> 
        <div class="head">
          <div class="subhea">
            <h1>
              Payment Transaction
            </h1>
          </div>
        <div class="listpurchase-footer">
          <h4>
            Total Price
          </h4>
          <h4>₱ {{ totalprice  }}</h4>
        </div>
        <div class="body">
          <ion-list>
            <ion-item>
              <ion-select :value="pm" @ionChange="pm=$event.target.value"  interface="popover" placeholder="Select Payment Transaction" >
                <ion-select-option value=0>GCASH</ion-select-option>
                <ion-select-option value=1>COD</ion-select-option>
                <ion-select-option value=2>CASH</ion-select-option>
              </ion-select>
            </ion-item>
          </ion-list>
          <div class="semi-body">
            <ion-button @click ="Purchase">
              Purchase Order
            </ion-button>
          </div>
        </div>
      </div>
    </div>
    <div class="receipt-transaction" v-bind:class="{hidden:isActiveReceipt}">
      <h2>Receipt</h2>
      <div class="listpurchase-body">
        <ion-list>
          <ion-item v-for = "order in order1" :key="order">
                  <ion-label>
                    {{ order.name }}
                  </ion-label>
                  <p>
                    ₱ {{ order.price }}
                  </p>
          </ion-item>
        </ion-list>
      </div>
      <div class="listpurchase-footer">
          <h3>Total Price</h3>
          <h3>{{ totalprice  }}</h3>
      </div>
      <div class="action">
        <ion-button @click ="Home">
          Back to Home
        </ion-button>
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
      IonCheckbox,
      IonList,
      IonItem,
      IonToolbar,
      IonSelect, 
      IonSelectOption,
      toastController
    } from '@ionic/vue';
    import { defineComponent } from 'vue';
    import axios from 'axios';

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
        IonSelect, IonSelectOption 
      }, data() {
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
                count:0,
                isActiveOrderList:false,
                isActivePurchaseList:true,
                isActiveTransaction:true,
                isActiveReceipt:true,
                totalprice:0,
                pm:0,
                isExist:false,
                userid:localStorage.getItem("id")
            }
        },mounted(){
            this.loadFoods();
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
            addorder(id:never,price:never,namefood:never){
              console.log(this.isExist);
              for (let index = 0; index < this.order1.length; ++index) {
                  if(this.order1[index].ids == id){
                    this.isExist = true;
                    break;
                  }
              }
              
              if(this.isExist){
                this.order1 = this.order1.filter(val => val.ids !== id)
                this.isExist = false;
              }else{
                this.order1.push({
                  ids:id,
                  name:namefood,
                  price:price,
                  userid:JSON.parse(this.userid as string)
                });
              }
              // console.log(this.orders.foodname);
              console.log(this.order1);
            },
            loadFoods(){ 
                axios.get('http://localhost:80/api/foods.php')
                .then((response) => {
                    this.foods = response.data;
                });
            },
            Continue(){
                this.isActiveOrderList = true;
                this.isActivePurchaseList = false;
                axios.post('http://localhost:80/api/tools.php',null,{
                  params:{
                    "listprice":this.order1,
                  }
                })
                .then((response) => {
                    console.log(response.data);
                    if(response.data.status==1){
                      this.totalprice = response.data.data;
                    }
                  });            
                },
                Order(){
                  console.log("Order");
                  this.isActiveTransaction = false;
                  this.isActivePurchaseList = true;
                },
                Purchase(){
                  axios.post('http://localhost:80/api/order.php',null,{
                    params:{
                      "order":this.order1,
                      "paymentmode":this.pm,
                    }
                  })
                  .then((response) => {
                    console.log(response.data.status);
                    
                    if(response.data.status==3){
                      window.open(response.data.link);
                    }

                    if(response.data.status==1){
                      this.showToastMessage();
                      this.isActiveReceipt = false;
                      this.isActiveTransaction = true;
                    }
                  });     
             },
             Logout(){
                localStorage.clear();
              },
            Home(){
              this.$router.push("/home");
            },
            CheckSession(){
                if(localStorage.getItem('id') === null){
                    this.$router.push("/login");
                }
            },
        }
    });
  </script>
  
  <style>
  .img-static {
    width: 90px !important;
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
    min-height: auto !important;
    position: relative;
  }
  .x-tools{
    position: relative !important;
    width: 100%;
    bottom: 0px !important;
  }
  ion-button{
    width: 100%;
  }
  
  h4{
    color: #000;
  }

  </style>