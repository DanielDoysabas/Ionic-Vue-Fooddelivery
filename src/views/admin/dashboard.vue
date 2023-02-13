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
        <ion-title>Dashboard</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content class="ion-padding">
        <div class="head">
          <h2>Activity History</h2>
        </div>
        <div class="activity-history">
          
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
    IonToolbar
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
      IonToolbar
    }, data() {
      return {
        data_activity:[],
        userid:localStorage.getItem("id"),
        activity_purchase:[]
      }
    }, mounted(){
      this.CheckSession();
    }, methods: {
        ExpandData(data:any){
          const a = data.orderlist;
          this.activity_purchase = JSON.parse(a as string)
          console.log(this.activity_purchase);
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
        FetchHistory(){
          console.log("test");
        }
    }
  });
</script>

<style>
#background-content {
  background: #fff !important;
}
ion-label,p, ion-title{
  color: #fff !important;
}
ion-item{
  background: transparent !important;
}
.ion-padding{
  background: #1e1e1e;
}
.link-x{
  cursor: pointer;
}
.activity-history{
  display: flex;
  flex-wrap: wrap;
  flex-direction: column;
  gap: 1rem;
}
</style>