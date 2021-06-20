<template>
  <h1>Dashboard</h1>
  <h4 v-if="Reference">Votre Reference. {{Reference}}</h4>
  <form>

  <!-- date input -->
  <div class="form-outline mb-4">
    <input type="date" id="form4Example2" class="form-control" />
    <label class="form-label" for="form4Example2">Date rendez vous :</label>
  </div>

 <div class="form-outline mb-4">
   <select class="form-select" aria-label="Default select example">
  <option selected>Open this select menu</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>
    <label class="form-label" for="form4Example1">Creneau</label>
  </div>

  <!-- motif input -->
  <div class="form-outline mb-4">
    <textarea class="form-control" id="form4Example3" rows="4"></textarea>
    <label class="form-label" for="form4Example3">Motif</label>
  </div>

  <!-- Submit button -->
  <button type="submit" class="btn btn-primary btn-block mb-4">Prendre  rendez vous</button>
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
      <th scope="row">{{ r.Date }}</th>
      <td> {{ r.Num_creneau }} </td>
      <td>{{ r.Motif }}</td>
      <td colspan="2"> <button class="btn btn-danger">Delete</button> <button class="btn btn-warning">Update</button>  </td>
    </tr>
    
  </tbody>
</table>
</template>

<script>
 import axios from "axios";
export default {
name :'Dashboard',
date(){
  return{
    Reference: null,
   rdv :[],
  }
},
async created(){
  this.Reference = localStorage.getItem('Reference');;
   const response = await axios.post('http://localhost/brief06/src/Api/ReadRdv.php',{
     Reference: this.Reference});
      this.rdv =response.data;
      console.log(this.rdv)
}
}
</script>

<style>

</style>