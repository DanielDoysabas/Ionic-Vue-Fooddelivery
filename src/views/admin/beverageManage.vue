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
        <ion-title>BEVERAGE AVAILABLE</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content class="ion-padding">
      <div class="foodlist-container">
          <ion-button href="./admin_beverageadd">Add Beverage</ion-button>
          <ion-button href="./admin_beveragelist">View Beverages</ion-button>
      </div>
    </ion-content>
  </ion-page>
</template>
  
<script lang="ts">
  import { IonHeader, IonTitle, IonToolbar, IonContent, IonButton } from '@ionic/vue';
  import { defineComponent } from 'vue';

  export default defineComponent({
    components: { IonHeader, IonTitle, IonToolbar, IonContent, IonButton },
    data() {
      return {
      };
    }, mounted(){
      this.CheckSession();
    }, methods: {
      Logout(){
          localStorage.clear();
        },
        CheckSession(){
            if(localStorage.getItem('id') === null){
                console.log("false");
                this.$router.push("/login_admin");
            }
        },
    }
  });
</script>


  <style>
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