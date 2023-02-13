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
        <ion-title>Dashboard</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content class="ion-padding">
        <div class="head">
          <h2>Activity History</h2>
        </div>
        <div class="activity-history">
          <ion-accordion-group class="x-card" >
            <ion-accordion v-for = "data in data_activity" :key="data" @click ="ExpandData(data)" >
              <ion-item slot="header" color="light">
                <ion-label>Order: {{ data.transaction_number }}</ion-label>
                <p>Total : ₱ {{ data.totalprice }}</p>
              </ion-item>
              <div class="ion-padding" slot="content">
                <ion-list v-for = "data_purchase in activity_purchase" :key="data_purchase">
                  <ion-item>
                    <ion-label>{{ data_purchase.foodname }}</ion-label>
                    <p>₱ {{ data_purchase.price }}</p>
                  </ion-item>
                </ion-list>
                <div class="x-div-pending">
                    <h3>Status: {{ data.status }}</h3>
                </div>
              </div>
            </ion-accordion>
          </ion-accordion-group>
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
      this.FetchHistory();
    }, methods: {
        ExpandData(data:any){
          const a = data.orderlist;
          this.activity_purchase = JSON.parse(a as string)
          console.log(this.activity_purchase);
        },
        Logout(){
          localStorage.clear();
          this.$router.push("/login");
        },
        CheckSession(){
            if(localStorage.getItem('id') === null){
                console.log("false");
                this.$router.push("/login");
            }
        },
        FetchHistory(){
          axios.post('http://localhost:80/api/history.php',null,{
            params:{
              "id":this.userid
            }
          })
          .then((response) => {
            const a = response.data.data;
             for (let i = 0; i < a.length; i++) {
               console.log(a[i].status);
               if(a[i].status==0){
                 a[i].status = "Pending"; 
                }else if(a[i].status==1){
                  a[i].status = "Done"; 
                }
              }
              this.data_activity = a;
          }); 
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