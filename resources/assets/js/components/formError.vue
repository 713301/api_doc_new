<template>
	<span class="help-block red-text">
        <!-- this will be replaced by the error messages -->
		<slot></slot>
	</span>
</template>

<script>
	export default {
		props: ['errors'],
	}
</script>