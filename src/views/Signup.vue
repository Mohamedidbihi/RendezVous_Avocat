  <template>
    <div class="row">
        <div class="col-sm5 m-auto">
                <div class="text-center mb-4">
            <h1> Creation du compte Client </h1>
        </div>
<form action="" id="login-form" @submit.prevent="handleSubmit">
<div class="row">
    <div class="col-sm-12 form-group">
        <label for="Nom">Nom :</label>
        <input type="text" class="form-control form-control-lg" placeholder="Votre nom" v-model="nom">
    </div>
      <div class="col-sm-12 form-group">
        <label for="Prenom">Prenom :</label>
        <input type="text"  class="form-control form-control-lg" placeholder="Votre prenom" v-model="prenom">
    </div>
      <div class="col-sm-12 form-group">
        <label for="Profession">Profession :</label>
        <input type="text" class="form-control form-control-lg " placeholder="Votre profession" v-model="profession">
    </div>
    <div class="col-sm-12 form-group">
        <label for="Cin">Cin :</label>
        <input type="text"  class="form-control form-control-lg " placeholder="C.I.N" v-model="cin">
    </div>
     <div class="col-sm-12 form-group">
        <label for="Num">Numero de telephone :</label>
        <input type="number"  class="form-control form-control-lg" placeholder="Votre numero de telephone" v-model="tele">
    </div>
    <div class="pt-4 col-sm-12 form-group ">
        <button class="btn btn-primary btn-lg col-sm-4 mx-1" >S'enregistrer</button>
    </div>
     <div class="pt-4 col-sm-12 form-group mt-5">
<p>Vous-avez deja un compte ? <router-link to="/Login">Login</router-link></p>
    </div>
</div>
</form>
    </div>
    </div>
  </template>

<script>
 import axios from "axios";
  export default {
  name: 'Signup',
  data() {
      return {
          nom :'',
          prenom :'',
          profession:'',
          tele :'',
          cin:'',
          
      }
  },
  methods:{
  async handleSubmit(){
    const response = await axios.post('http://localhost/brief06/src/Api/Signup.php',{
            nom: this.nom,
            prenom: this.prenom,
            profession: this.profession,
            tele: this.tele,
            cin: this.cin});
            console.log(response);
            if(response.data.reference)
            {
            localStorage.setItem('Reference',response.data.reference)
            this.$router.push("/Dashboard");
            }
            else
            {
              alert(response.data.message)
            }

  },
},
}
</script>

<style>

</style>