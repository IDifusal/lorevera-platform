import{s as u,o as x,a as h,b as k,i as s,d as a,w as i,n,C as b,G as D,F as $,e as c,D as v,p as r,t as p,y as A,f as B}from"./app-BxxGe2Zv.js";const N={flex:""},T=s("h2",null,"List WarmUps",-1),E={__name:"List",setup(I){const m=B(),f=()=>{m.push({name:"warm-up-add"})},g=u([{title:"id",value:"id"},{title:"Name",align:"start",sortable:!1,value:"name"},{title:"Actions",value:"actions",sortable:!1}]),o=u({dialog:!1,itemid:null}),d=u([]),w=e=>{console.log(e),m.push({name:"warm-up-edit",params:{id:e.id}})},y=e=>{console.log("delete item",e),o.value.dialog=!0,o.value.itemid=e},C=async()=>{const e=o.value.itemid;try{await c.delete(`/api/web/delete-warmup/${e}`),d.value=d.value.filter(t=>t.id!==e)}catch(t){console.error(t)}o.value.dialog=!1,o.value.itemid=null},_=async()=>{try{const{data:e}=await c.get("/api/web/list-warmup");d.value=e}catch(e){console.error(e)}};return x(async()=>{await _()}),(e,t)=>(h(),k($,null,[s("div",N,[T,a(v),a(n,{color:"primary",onClick:t[0]||(t[0]=l=>f())},{default:i(()=>[r("Add")]),_:1})]),a(b,{headers:g.value,items:d.value,"items-per-page":100,class:"elevation-1 pt-5"},{item:i(l=>[s("tr",null,[s("td",null,p(l.item.id),1),s("td",null,p(l.item.name),1),s("td",null,[a(n,{color:"primary",text:"",onClick:V=>w(l.item)},{default:i(()=>[r(" Edit ")]),_:2},1032,["onClick"]),a(n,{color:"error",text:"",onClick:V=>y(l.item.id)},{default:i(()=>[r(" Delete ")]),_:2},1032,["onClick"])])])]),_:1},8,["headers","items"]),a(D,{modelValue:o.value.dialog,"onUpdate:modelValue":t[3]||(t[3]=l=>o.value.dialog=l),"max-width":"400",persistent:""},{default:i(()=>[a(A,{text:"Are you sure you want to delete this item?",title:"This will delete the item permanently."},{actions:i(()=>[a(v),a(n,{onClick:t[1]||(t[1]=l=>o.value.dialog=!1)},{default:i(()=>[r(" Cancel ")]),_:1}),a(n,{color:"lorevera",onClick:t[2]||(t[2]=l=>C())},{default:i(()=>[r(" Confirm ")]),_:1})]),_:1})]),_:1},8,["modelValue"])],64))}};export{E as default};