<template>
	<header-component></header-component>
	<div class="panel-heading border-x">
		<h2 class="margin-top-x margin-bottom-x grey-text lightest"> Add New Response</h2>
	</div>
	<div class="panel-body white thin-border">
		<form id="responseInput" action="#" @submit.prevent="edit ? updateResponse(response.id) : createResponse()">
		<div class="form-group@{{ errors.category ? ' has-error' : '' }}">
			<select v-model="response.category" class="form-control input-lg" name="category">
				<option value="" selected>Select a Category</option>
				<option value="AUTHENTICATION">AUTHENTICATION</option>
				<option value="VALIDATION">VALIDATION</option>
				<option value="SUCCESS">SUCCESS</option>
				<option value="CONFLICT">CONFLICT</option>
				<option value="ERROR">ERROR</option>
			</select>

		</div>
		<form-error v-if="errors.category" :errors="errors">
			{{ errors.category }}
		</form-error>

		<div class="form-group@{{ errors.code ? ' has-error' : '' }}">
			<label for="code">Response Code</label>
			<input v-model="response.code" v-el:responseinput type="number" name="code" class="form-control">
		</div>
		<form-error v-if="errors.code" :errors="errors">
			{{ errors.code }}
		</form-error>

		<div class="form-group">
			<label for="response_message">Response Message</label>
			<textarea v-model="response.response_message" name="response_message" class="form-control"></textarea>
		</div>

		<div class="form-group">
			<label for="description">Response Description</label>
			<textarea v-model="response.description" name="description" class="form-control"></textarea>
		</div>

		<div class="form-group">
			<label for="is_active" class="left">Set Status (default false not to publish)</label>
			<label class="switch clear">
				<input type="checkbox" v-model="response.is_active" name="is_active">
				<div class="slider round"></div>
			</label>
		</div>

		<div class="form-group">
			<button type="submit" v-show="!edit" class="btn btn-primary padding-x bolder uppercase">Submit</button>
			<button type="submit" v-show="edit" class="btn btn-warning padding-x bolder uppercase">Update</button>
		</form>	

		<div class="row margin-top-2x" v-cloak>
			<h2 class="margin-bottom-2x black-text margin-top-2x black-text bold">View Response Codes</h2>
			<table class="table">
				<thead>
					<tr>
						<th>id</th>
						<th>Category</th>
						<th>Code</th>
						<th>Response Message</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="response in list">
						<td>{{ $index+1 }}</td>
						<td>{{response.category}}</td>
						<td>{{response.code}}</td>
						<td>{{response.response_message}}</td>
						<td>{{response.description}}</td>
						<td>
							<a @click="showResponse(response.id)" class="btn btn-info btn-xs">Edit</a>
							<a @click="deleteResponse(response.id)" class="btn btn-danger btn-xs margin-top-x">Delete</a>
						</td>
					</tr>
					<tr v-if="list.length == 0">
						<td colspan="6" class="text-center red-text bolder font-2x">
							No record found. Add a new record.
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</template>
	<script>
		import Sidebar from './Sidepanel.vue';
		import FormError from './formError.vue';
		export default {
			props: ['errors'],
			components: {
				'header-component': Sidebar,
				'form-error' : FormError
			},
			data: function() { 
				return {
					edit: false,
					list: [],
					response: {
						id: '',
						category: '',
						code: '',
						response_message: '',
						description: '',
						is_active: ''
					}
				};
			},
			submitted: false,

	    // array to hold form errors
	    errors: [],
	    ready: function() {
	    	$(".loading").fadeIn("slow");
	    	this.fetchResponseList();
	    },
	    methods: {
	    	fetchResponseList: function() {
	    		this.$http.get('api/response/0').then(function (response) {
	    			this.list = response.data;
	    			$(".loading").fadeOut("slow");
	    		});
	    	},

	    	createResponse: function () {
	    		let post = this.post;
	    		//$(".loading").fadeIn("slow");
	    		this.$http.post('api/response/new', this.response).then(function (response) {
	    			$('#responseInput')[0].reset();
	    			this.$set('errors', '');

	    			this.submitted = true;
	    			this.edit = false
	    			this.fetchResponseList()
					// clear previous form errors

				}, function(response) {
			    // form submission failed, pass form  errors to errors array
			    this.$set('errors', response.data);
			});
	    	},

	    	showResponse: function(id) {
	    		$(".loading").fadeIn("slow");
	    		this.$http.get('api/response/'+id).then(function(response) {
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
	    		this.$els.responseinput.focus()
	    		this.edit = true
	    	},

	    	updateResponse: function(id) {
	    		$(".loading").fadeIn("slow");
	    		this.$http.patch('api/response/'+id, this.response).then(function (response) {
	    			$('#responseInput')[0].reset();
	    			this.edit = false
	    			$(".loading").fadeOut("slow");
	    			this.fetchResponseList()
	    		}, function (response) {
					    // Error
					    console.error("Error Occured");
					});
	    	},

	    	deleteResponse: function (id) {
	    		$(".loading").fadeIn("slow");
	    		this.$http.delete('api/response/delete/'+id).then(function (response) {
	    			if(response.data){
	    				this.fetchResponseList()
	    			}
	    		});
	    	},
	    },
	}
</script>