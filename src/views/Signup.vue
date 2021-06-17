  <template>
    <div class="row">
        <div class="col-sm5 m-auto">
                <div class="text-center mb-4">
            <h1> Creation du compte Client </h1>
        </div>
<form action="" id="login-form">
<div class="row">
    <div class="col-sm-12 form-group">
        <label for="Reference">Nom :</label>
        <input type="text" id="reference" class="form-control form-control-lg" placeholder="Votre nom" v-model="Nom">
    </div>
      <div class="col-sm-12 form-group">
        <label for="Reference">Prenom :</label>
        <input type="text" id="reference" class="form-control form-control-lg" placeholder="Votre prenom" v-model="Prenom">
    </div>
      <div class="col-sm-12 form-group">
        <label for="Reference">Profession :</label>
        <input type="text" id="reference" class="form-control form-control-lg " placeholder="Vitre profession" v-model="Profession">
    </div>
     <div class="col-sm-12 form-group">
        <label for="Reference">Numero de telephone :</label>
        <input type="number" id="reference" class="form-control form-control-lg" placeholder="votre numero de telephone" v-model="Num">
    </div>
    <div class="pt-4 col-sm-12 form-group ">
        <button class="btn btn-primary btn-lg col-sm-4 mx-1" @click.prevent="Signup">S'enregistrer</button>
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
  export default {
  name: 'Signup',
  data() {
      return {
          Nom :'',
          Prenom :'',
          Profression:'',
          Num :'',
      }
  },
  methods:{
      Signup()
      {
          console.log('Perform Signup');
          
      } 
  }
  }
</script>

<style>

</style>