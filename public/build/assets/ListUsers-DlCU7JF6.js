import{a as n,c,d as s,F as l,b as i,r as a,o as _}from"./app-CiWbtBBw.js";import{_ as p}from"./_plugin-vue_export-helper-DlAUqK2U.js";const d={data(){return{headers:[{text:"id",value:"id"},{text:"Name",align:"start",sortable:!1,value:"name"},{text:"Register Date",value:"created_at"},{text:"Phone",value:"phone"},{text:"Email",value:"email"}],users:[]}},created(){try{n.get("/users").then(({data:e})=>this.users=e)}catch(e){console.table(e)}}},m=i("h2",null,"List Users",-1);function u(e,h,v,x,t,f){const r=a("v-spacer"),o=a("v-data-table");return _(),c(l,null,[m,s(r),s(o,{headers:t.headers,items:t.users,"items-per-page":5,class:"elevation-1 pt-5"},null,8,["headers","items"])],64)}const B=p(d,[["render",u]]);export{B as default};
