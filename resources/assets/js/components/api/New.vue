<template>
	<header-component></header-component>

	<div class="panel-heading border-x">
		<h2 class="margin-top-x margin-bottom-x grey-text"> Add new API</h2>
	</div>
	<div class="panel-body white thin-border">
		<div class="container margin-left-off margin-right-off full-width no-padding" v-cloak>
			<!-- <a  v-link="{ name: 'list-api' }" class="btn btn-success no-radius btn-lg white-text bolder margin-bottom-x" role="button">VIEW API LIST</a> -->
			<form id="apiInput" action="#" @submit.prevent="edit ? updateApi(response.id) : createApi()">

				<div class="form-group">
					<label for="api_zone">Api Zone</label>
					<select v-model="response.api_zone" class="form-control input-lg uppercase" name="api_zone">
						<option value="" selected>Select api zone</option>
						<option value="customer">Customer</option>
						<option value="contributor">Contributor</option>
						<option value="others">Others</option>					
					</select>
				</div>

				<div class="form-group">
					<label for="response_type">Response Content Type</label>
					<select v-model="response.response_type" class="form-control input-lg uppercase" name="response_type">
						<option value="" selected>Select application content Type</option>
						<option value="application/json">application/json</option>
						<option value="application/x-javascript">application/x-javascript</option>
						<option value="text/javascript">text/javascript</option>
						<option value="text/x-javascript">text/x-javascript</option>
						<option value="text/x-json">text/x-json</option>
					</select>
				</div>

				<div class="form-group full-width">
					<label for="name">Api Method</label>
					<select v-model="response.method" class="form-control input-lg" name="method">
						<option value="" selected>Select a method</option>
						<option value="POST">POST</option>
						<option value="GET">GET</option>
						<option value="PUT">PUT</option>
						<option value="DELETE">DELETE</option>
						<option value="PATCH">PATCH</option>
					</select>
				</div>

				<div class="form-group">
					<label for="name">API Name</label>
					<input v-model="response.api_name" v-el:api-input type="text" name="api_name" class="form-control">
				</div>

				<div class="form-group">
					<label for="description">API Description</label>
					<textarea v-model="response.description" v-el:api-input name="description" class="form-control"></textarea>
				</div>

				<div class="form-group">
					<label for="api_uri">API URI</label>
					<input v-model="response.api_uri" v-el:api-input type="text" name="api_uri" class="form-control">
				</div>

				<div class="form-group">
					<label for="parameters">API Paremeters</label>
					<textarea v-model="response.parameters" v-el:api-input name="paremeters" class="form-control"></textarea>
				</div>

				<div class="form-group">
					<label for="success_response">Success Response </label>
					<textarea v-model="response.success_response" v-el:api-input name="success_response" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<label for="error_response">Failure Response </label>
					<textarea v-model="response.error_response" v-el:api-input name="error_response" class="form-control"></textarea>
				</div>

				<div class="form-group">
					<label for="validations">API Validations(if any)</label>
					<textarea v-model="response.validations" v-el:api-input name="validations" class="form-control"></textarea>
				</div>

				<div class="form-group">
					<label for="is_active" class="left">Set Status (default false not to publish)</label>
					<label class="switch clear">
						<input type="checkbox" v-model="response.is_active" name="is_active">
						<div class="slider round"></div>
					</label>
				</div>

				<div class="form-group">
					<button type="submit" v-show="!edit" class="btn btn-success padding-x bolder uppercase">Submit</button>
					<button type="submit" v-show="edit" class="btn btn-warning padding-x bolder uppercase">Update</button>
				</div>	
			</form>
		</div>
	</div>
</template>
<script>
	import VueResource from 'vue-resource';
	import Sidebar from '../Sidepanel.vue';
	export default {
		components: {
			'header-component': Sidebar
		},
		data: function() { 
			return {
				response: {
					api_zone:'',
					api_name: '',
					description: '',
					api_uri:'',
					method: '',
					parameters: '',
					success_response:'',
					error_response: '',
					response_type:'',
					validations:'',
					created_by:'',
					updated_by:'',
					is_active:'',
					created_at:'',
					updated_at:''
				},
			};
		},
		ready: function() {
				//$(".loading").fadeIn("slow");	
				var itemId = this.$route.params.resource_id;
				if(itemId){
					// $(".loading").fadeIn("slow");
					this.$root.$http.get('api/list/'+this.$route.params.resource_id).then(function(response) {
						console.log(response.data[0]);
						for(var obj_key in response.data[0])
							this.response[obj_key] = response.data[0][obj_key]
						if(response.data[0].is_active){
							this.response.is_active = true
						}
						else{
							this.response.is_active = false
						}
						$(".loading").fadeOut("slow");
					})
					//this.$els.apiInput.focus()
					this.edit = true
				}
			},
			methods: {
				
				/*to create a api document*/

				createApi: function () {
					$(".loading").fadeIn("slow");
					this.$root.$http.get('login/check').then(function (response) {
	    				if(response.status == 200 && (response.data))
	    				this.authenticated = true;
	    				if(this.authenticated) {
	    					this.response.created_by = response.data.id;
							this.$root.$http.post('api/new', this.response).then(function (response) {
								$('#apiInput')[0].reset();
								this.$route.router.go({name: 'list-api'});
							}, function(response) {
								// form submission failed, pass form  errors to errors array
								    this.$set('errors', response.data);
							});
	    				}
	    				else{
	    					window.location.href = "./login"
	    				}
					});
				},

				/*to update the existing api list*/
				updateApi: function(id) {
					$(".loading").fadeIn("slow");
					this.$root.$http.patch('api/list/'+id, this.response).then(function (response) {
						$('#apiInput')[0].reset();
						this.edit = false
						$(".loading").fadeOut("slow");
						this.$route.router.go({name: 'list-api'});
					}, function (response) {
					    // Error
					    console.error("Error Occured");
					});
				}
			},
		}
	</script>