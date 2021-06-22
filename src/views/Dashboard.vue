<template>
   <button class="btn btn-danger float-end" @click.prevent="Logout">Deconnexion</button>
  <h1>Dashboard</h1>
  <h4 v-if="Reference">Votre Reference. {{Reference}}</h4>
  <form>

  <!-- date input -->
   <input type="hidden" id="form4Example2" class="form-control" v-model="Id_rdv"/>
  <div class="form-outline mb-4">
    <input type="date" id="form4Example2" class="form-control" v-model="date" @change="RecupCreneau"/>
    <label class="form-label" for="form4Example2" >Date rendez vous :</label>
  </div>

 <div class="form-outline mb-4">
   <select class="form-select" aria-label="Default select example" v-model="Num_creneau">
  <option selected disabled>Selectionner un horaire</option>
  <option v-for="creneau in creneaus" :value=creneau.Num_creneau :key="creneau.Num_creneau">
    {{creneau.Horaire}}
  </option>

</select>
    <label class="form-label" for="form4Example1">Creneau</label>
  </div>

  <!-- motif input -->
  <div class="form-outline mb-4">
    <textarea class="form-control" id="form4Example3" rows="4" v-model="Motif"></textarea>
    <label class="form-label" for="form4Example3">Motif</label>
  </div>

  <!-- Submit button -->
  <button v-if="b" class="btn btn-warning btn-block mb-4" @click.prevent="UpdateRdv">Modifer rendez vous</button>
  <button v-else class="btn btn-primary btn-block mb-4" @click.prevent="Add">Prendre rendez vous</button>
</form>
  <table class="table table-success table-striped">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Creneau</th>
      <th scope="col">Motif</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="r in rdv" :key="r.Id_rdv">
      <th>{{ r.Date }}</th>
      <td> {{ r.Horaire }} </td>
      <td>{{ r.Motif}}</td>
      <td colspan="2"> <button type="submit" class="btn btn-danger" @click.prevent="Del(r.Id_rdv)">Delete</button> <button class="btn btn-warning" @click.prevent="Upd(r.Id_rdv,r.Date,r.Horaire,r.Motif)">Update</button>  </td>
    </tr>
    
  </tbody>
</table>
</template>

<script>
 import axios from "axios";
export default {
name :'Dashboard',
data() {
  return{
   b:false,
   Reference: null,
   rdv :[],
   date :'',
   Num_creneau :'',
   creneaus:{},
   Motif:'',
   Id_rdv:''
  }
},
methods:{
RecupCreneau:function()
{
     console.log(this.date)
      axios.post('http://localhost/brief06/src/Api/Creneau.php',{
       Date : this.date 
      })
            .then(function( response ){
                 this.creneaus = response.data;

                //  console.log(this.creneaus.Num_creneau)
            }.bind(this));
},

Add:function()
{
   const today = new Date();
   const datenow = today.getFullYear()+'-0'+(today.getMonth()+1)+'-'+today.getDate();
  if(datenow > this.date)
  {
alert("Veuillez choisir une date valide !!")
  }
  else
  {
        axios.post('http://localhost/brief06/src/Api/Add_Rdv.php',{
       Reference : this.Reference,
       Motif : this.Motif,
       Date :  this.date ,
       Num_creneau : this.Num_creneau
      })
            .then(function( response ){
              this.getrdv();
                 alert(response.data.message)
            }.bind(this));
}},
 Logout()
 {
      
      localStorage.clear();
      this.$router.push("/Login");
      // location.reload();

 },
UpdateRdv:function()
{
        axios.post('http://localhost/brief06/src/Api/Update.php',{
       Motif : this.Motif,
       Date :  this.date ,
       Num_creneau : this.Num_creneau,
       Id_rdv : this.Id_rdv
      })
            .then(function( response ){
              this.getrdv();
                 console.log(response.data)
                 this.b=0;
            }.bind(this));
console.log(this.date)
},
   Upd(id, date, horaire, motif) {
     const today = new Date();
      const datenow =
        today.getFullYear() +
        "-0" +
        (today.getMonth() + 1) +
        "-" +
        today.getDate();
        if(datenow > date)
        {
          alert("Impossible de modifier historique, Que les rendez vous pas encore passe")
        }
        else
        {
      this.b = true;
      this.Id_rdv=id,
      this.date = date,
      this.creneau = horaire,
      this.Motif = motif;
        }
        console.log(id)
    },
  Del(id,date) {
 const today = new Date();
      const datenow =
        today.getFullYear() +
        "-0" +
        (today.getMonth() + 1) +
        "-" +
        today.getDate();
        if(datenow < date)
        {
          alert("Impossible de supprimer historique, Que les rendez vous pas encore passe")
        }
        else
        {
      axios
        .post("http://localhost/brief06/src/Api/Delete_Rdv.php", {
          Id_rdv: id,
        })
        .then(
          function (response) {
           
            alert(response.data.message);
            this.getrdv();
          }.bind(this)
          
        );
    }
},
 async getrdv(){
    this.Reference = localStorage.getItem('Reference');
     await axios.post('http://localhost/brief06/src/Api/ReadRdv.php',{
      Reference:this.Reference
      })
            .then(function( response ){
             this.rdv = response.data;
            }.bind(this));  
}
},
mounted(){
  this.getrdv();
}

}
</script>

<style>

</style>