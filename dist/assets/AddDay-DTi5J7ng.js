import{u as b,S,E as k}from"./index-DP_puyG-.js";import{s as o,o as q,a as U,b as C,p as V,d as a,j as N,I as g,w as s,v as E,n as T,i as n,x as c,J as m}from"./app-BzRu1lno.js";const W=n("label",{for:"name"},"Title:",-1),B=n("label",{for:"quantity"},"Description:",-1),D=n("label",{for:""},"Select Equipment",-1),J=n("label",{for:""},"Select Warm Up",-1),L=n("label",{for:""},"Select Workouts",-1),M={__name:"AddDay",setup(O){const p=o([]),v=o([]),f=o([]),w=b({content:"<p>Content <strong> add here</strong></p>",extensions:[S]}),r=o({}),i=o([]),u=o([]),d=o([]),y=async()=>{try{const{data:e}=await axios.get("/api/web/list-equipment");for(let t=0;t<e.length;t++)e[t].title=e[t].name;p.value=e}catch(e){console.error(e)}},_=async()=>{try{const{data:e}=await axios.get("/api/web/list-warmup");for(let t=0;t<e.length;t++)e[t].title=e[t].name;v.value=e}catch(e){console.error(e)}},h=async()=>{try{const{data:e}=await axios.get("/api/web/list-workout");for(let t=0;t<e.length;t++)e[t].title=e[t].name;f.value=e}catch(e){console.error(e)}},x=async()=>{if(!r.value.title){alert("Title is required");return}const e=new FormData;e.append("title",r.value.title),e.append("content",w.value.getHTML()),e.append("equipment",JSON.stringify(i.value)),e.append("warmUp",JSON.stringify(u.value)),e.append("workout",JSON.stringify(d.value));try{const t=await axios.post("/api/web/store-day",e,{headers:{"Content-Type":"multipart/form-data"}});console.log(t)}catch(t){console.error(t)}};return q(async()=>{await y(),await _(),await h()}),(e,t)=>(U(),C("div",null,[V(" Creating a day "),W,a(N,{modelValue:r.value.title,"onUpdate:modelValue":t[0]||(t[0]=l=>r.value.title=l),"hide-details":"","single-line":"",rules:[l=>!!l||"Name is required"]},null,8,["modelValue","rules"]),B,a(g(k),{editor:g(w)},null,8,["editor"]),a(E,null,{default:s(()=>[a(c,{cols:"4"},{default:s(()=>[D,a(m,{modelValue:i.value,"onUpdate:modelValue":t[1]||(t[1]=l=>i.value=l),items:p.value,"item-value":"id",multiple:"",chips:""},null,8,["modelValue","items"])]),_:1}),a(c,{cols:"4"},{default:s(()=>[J,a(m,{modelValue:u.value,"onUpdate:modelValue":t[2]||(t[2]=l=>u.value=l),items:v.value,multiple:"","item-value":"id",chips:""},null,8,["modelValue","items"])]),_:1}),a(c,{cols:"4"},{default:s(()=>[L,a(m,{modelValue:d.value,"onUpdate:modelValue":t[3]||(t[3]=l=>d.value=l),items:f.value,multiple:"","item-value":"id",chips:""},null,8,["modelValue","items"])]),_:1})]),_:1}),a(T,{class:"mt-10",color:"lorevera",onClick:x},{default:s(()=>[V("Save Changes")]),_:1})]))}};export{M as default};