  <template>
    <div class="row">
        <div class="col-sm5 m-auto">
                <div class="text-center mb-4">
            <h1> Authentification </h1>
        </div>
<form action="" id="login-form">
<div class="row">
    <div class="col-sm-12 form-group">
        <label for="Reference">Reference :</label>
        <input type="text" id="reference" class="form-control form-control-lg" v-model="Reference">
    </div>

    <div class="pt-4 col-sm-12 form-group ">
        <button class="btn btn-primary btn-lg col-sm-4 mx-1" @click.prevent="Login" >S'authentifier</button>
    </div>
    <div class="pt-4 col-sm-12 form-group mt-5">
<p>Créer un compte ? <router-link to="/Signup">Signup</router-link></p>
    </div>
</div>
</form>
    </div>
    </div>
  </template>
  
  <script>
  export default {
  name: 'Login',
  data() {
      return {
          Reference :''
      }
  },
  methods:{
      Login()
      {
          console.log('Perform login');
          
      } 
  }
  }
  </script>
  
  <style>
  
  </style>