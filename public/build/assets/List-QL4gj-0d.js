import{s as u,o as V,a as x,b as h,i as s,d as a,w as i,n,C as b,G as D,F as $,e as c,D as v,p as r,t as f,y as A,f as B}from"./app-BxxGe2Zv.js";const N={flex:""},T=s("h2",null,"List Workout",-1),E={__name:"List",setup(I){const m=B(),p=()=>{m.push({name:"workout-add"})},o=u({dialog:!1,itemid:null}),g=u([{title:"id",value:"id"},{title:"Name",align:"start",sortable:!1,value:"name"},{title:"Actions",value:"actions",sortable:!1}]),d=u([]),w=e=>{console.log("delete item",e),o.value.dialog=!0,o.value.itemid=e},k=e=>{console.log(e),m.push({name:"warm-up-edit",params:{id:e.id}})},y=async()=>{const e=o.value.itemid;try{await c.delete(`/api/web/delete-warmup/${e}`),d.value=d.value.filter(t=>t.id!==e)}catch(t){console.error(t)}o.value.dialog=!1,o.value.itemid=null},C=async()=>{try{const{data:e}=await c.get("/api/web/list-workout");d.value=e}catch(e){console.error(e)}};return V(async()=>{await C()}),(e,t)=>(x(),h($,null,[s("div",N,[T,a(v),a(n,{color:"primary",onClick:t[0]||(t[0]=l=>p())},{default:i(()=>[r("Add")]),_:1})]),a(b,{headers:g.value,items:d.value,"items-per-page":100,class:"elevation-1 pt-5"},{item:i(l=>[s("tr",null,[s("td",null,f(l.item.id),1),s("td",null,f(l.item.name),1),s("td",null,[a(n,{color:"primary",text:"",onClick:_=>k(l.item)},{default:i(()=>[r(" Edit ")]),_:2},1032,["onClick"]),a(n,{color:"error",text:"",onClick:_=>w(l.item.id)},{default:i(()=>[r(" Delete ")]),_:2},1032,["onClick"])])])]),_:1},8,["headers","items"]),a(D,{modelValue:o.value.dialog,"onUpdate:modelValue":t[3]||(t[3]=l=>o.value.dialog=l),"max-width":"400",persistent:""},{default:i(()=>[a(A,{text:"Are you sure you want to delete this item?",title:"This will delete the item permanently."},{actions:i(()=>[a(v),a(n,{onClick:t[1]||(t[1]=l=>o.value.dialog=!1)},{default:i(()=>[r(" Cancel ")]),_:1}),a(n,{color:"lorevera",onClick:t[2]||(t[2]=l=>y())},{default:i(()=>[r(" Confirm ")]),_:1})]),_:1})]),_:1},8,["modelValue"])],64))}};export{E as default};