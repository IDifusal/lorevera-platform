import{a as c,c as l,w as i,r as t,o as _,d as a,b as p}from"./app-DouUbhVd.js";import{_ as d}from"./_plugin-vue_export-helper-DlAUqK2U.js";const m={data(){return{headers:[{text:"id",value:"id"},{text:"Name",align:"start",sortable:!1,value:"name"},{text:"Register Date",value:"created_at"},{text:"Phone",value:"phone"},{text:"Email",value:"email"}],users:[]}},created(){try{c.get("/users").then(({data:e})=>this.users=e)}catch(e){console.table(e)}}},u=p("h2",null,"List Users",-1);function h(e,v,x,f,s,b){const r=t("v-spacer"),o=t("v-data-table"),n=t("v-main");return _(),l(n,null,{default:i(()=>[u,a(r),a(o,{headers:s.headers,items:s.users,"items-per-page":5,class:"elevation-1 pt-5"},null,8,["headers","items"])]),_:1})}const N=d(m,[["render",h]]);export{N as default};
