<template>
	<header-component></header-component>
	<div class="panel-heading thin-border">
		<h2 class="margin-top-x margin-bottom-x grey-text lightest uppercase"> Recently Added</h2>
	</div>

	<div class="container margin-left-off margin-right-off full-width no-padding">
		
		<!--loop through data-->
		<div class="jumbotron light-grey padding-2x thin-border margin-bottom-2x" v-for="response in list">
			<h2 class="margin-top-off">{{ response.api_name }}</h2>

			<p class="black-text bolder"> Type: <b>{{response.response_type}}</b></p>

			<label class="info margin-top-x dark-blue-text">Method Type</label>
			<p><label class="white-text dark-blue padding-x">{{response.method}}</label></p>

			<div class="api-info font-1-5x margin-top-2x">
				<label class="info dark-blue-text">Description</label>
				<p class="black-text">{{response.description}}</p>

				<label class="info margin-top-x dark-blue-text">API URI</label>
				<p class="black-text bolder border-x padding-x">{{response.api_uri}}</p>

				<label class="info margin-top-x dark-blue-text">Response Parameters</label>
				<p class="black-text primary-black json-container padding-2x white-text" v-if="!response.parameters">NA</p>
				<p class="black-text primary-black json-container padding-2x white-text" v-else>{{response.parameters}}</p>

				<label class="info margin-top-x dark-blue-text">Success Response</label>
				<p class="black-text primary-black json-container padding-2x white-text" v-if="!response.success_response">NA</p>
				<p class="black-text primary-green json-container padding-2x white-text" v-else>{{response.success_response}}</p>

				<label class="info margin-top-x dark-blue-text">Failure Response</label>
				<p class="black-text red json-container padding-2x white-text" v-if="!response.error_response">NA</p>
				<p class="black-text red json-container padding-2x white-text" v-else>{{response.error_response}}</p>
				
				<label class="info margin-top-x dark-blue-text">Vaildations</label>
				<p class="black-text bg-info json-container padding-2x" v-if="!response.validations">NA</p>
				<p class="black-text bg-info padding-x" v-else>{{response.validations}}</p>
			</div>
		</div>

		<!--if no list content-->
		<div class="jumbotron light-grey padding-2x thin-border margin-bottom-off" v-if="list.length == 0">
			<h3 class="margin-top-off red-text lightest">No record found. Add a new record.</h3>
		</div>
	</div>

</template>
<script>
	import Sidebar from '../Sidepanel.vue';
	export default {
		components: {
			'header-component': Sidebar
		},
		data: function() { 
			return {
				list: []
			};
		},
		ready: function() {
			$(".loading").fadeIn("slow");
			this.fetchAPIList();
		},
		methods: {
			
			fetchAPIList: function() {
				this.$http.get('api/list/category/recent').then(function (response) {
					this.list = response.data;
					//console.log(this.list);
					$(".loading").fadeOut("slow");
				});
			}
		},
	}
</script>