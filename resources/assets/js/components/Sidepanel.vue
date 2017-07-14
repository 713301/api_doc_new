<template>

  <nav id="sidebar">
    <div class="sidebar-header">
      <a class="white-text bolder" v-link="{ name: 'list-api' }" role="button"> 
        <h3 class="bolder"> <img class="logo" :src="'./images/icon-api.png'" />Breeze</h3> 
      </a>
    </div>
    <ul class="list-unstyled components margin-left-off">
      <li class="active">
       <a href="#customerSubmenu" data-toggle="collapse" aria-expanded="false" class="uppercase white-text">api docs</a>
        <ul class="collapse list-unstyled margin-left-off" id="customerSubmenu">
          <li>
            <a class="uppercase" v-link="{ name: 'add-api' }">ADD API</a>
          </li>
          <li>
            <a v-link="{ name: 'get-resource_cus' }" role="button">Customers List</a>
          </li>
          <li>
            <a v-link="{ name: 'get-resource_con' }" role="button">Contributors List</a>
          </li>
        </ul>
      </li>
      <li>
       <a href="#responseSubmenu" data-toggle="collapse" aria-expanded="false" class="uppercase white-text" role="button">responses</a>
       <ul class="collapse list-unstyled margin-left-off" id="responseSubmenu">
          <li>
            <a class="uppercase" v-link="{ name: 'add-response' }">add response</a>
          </li>
        </ul>
     </li>
   </ul>
 </nav>
</template>
<script>
  export default {
    name: 'Sidebar'
  };
</script>

