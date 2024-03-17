import{u as q,S,E}from"./index-CxtJX7Sq.js";import{s as l,o as U,a as C,b as N,p as g,d as o,j as T,I as V,w as i,v as W,n as D,i as n,x as m,J as p,f as B}from"./app-CGGBKZkl.js";const J=n("label",{for:"name"},"Title:",-1),L=n("label",{for:"quantity"},"Description:",-1),O=n("label",{for:""},"Select Equipment",-1),I=n("label",{for:""},"Select Warm Up",-1),R=n("label",{for:""},"Select Workouts",-1),j={__name:"EditDay",setup(F){const v=l([]),w=l([]),f=l([]),y=B(),c=q({content:"",extensions:[S]}),s=l({}),r=l([]),u=l([]),d=l([]),h=async()=>{try{const{data:t}=await axios.get("/api/web/list-equipment");for(let e=0;e<t.length;e++)t[e].title=t[e].name;v.value=t}catch(t){console.error(t)}},_=async()=>{try{const{data:t}=await axios.get("/api/web/list-warmup");for(let e=0;e<t.length;e++)t[e].title=t[e].name;w.value=t}catch(t){console.error(t)}},x=async()=>{try{const{data:t}=await axios.get("/api/web/list-workout");for(let e=0;e<t.length;e++)t[e].title=t[e].name;f.value=t}catch(t){console.error(t)}},b=async()=>{if(!s.value.title){alert("Title is required");return}const t=new FormData;t.append("title",s.value.title),t.append("content",c.value.getHTML()),t.append("equipment",JSON.stringify(r.value)),t.append("warmUp",JSON.stringify(u.value)),t.append("workout",JSON.stringify(d.value));try{const e=window.location.pathname.split("/").pop(),a=await axios.post(`/api/web/update-day/${e}`,t,{headers:{"Content-Type":"multipart/form-data"}});y.push({name:"days"})}catch(e){console.error(e)}},k=async()=>{const t=y.currentRoute.value.params.id;console.log(t);try{const{data:e}=await axios.get(`/api/web/get-day/${t}`);s.value=e,c.value.commands.setContent(e.description),r.value=e.equipment.map(a=>a.id),u.value=e.warmups.map(a=>a.id),d.value=e.workouts.map(a=>a.id)}catch(e){console.error(e)}};return U(async()=>{await h(),await _(),await x(),await k()}),(t,e)=>(C(),N("div",null,[g(" Editting a day "),J,o(T,{modelValue:s.value.title,"onUpdate:modelValue":e[0]||(e[0]=a=>s.value.title=a),"hide-details":"","single-line":"",rules:[a=>!!a||"Name is required"]},null,8,["modelValue","rules"]),L,o(V(E),{editor:V(c)},null,8,["editor"]),o(W,null,{default:i(()=>[o(m,{cols:"4"},{default:i(()=>[O,o(p,{modelValue:r.value,"onUpdate:modelValue":e[1]||(e[1]=a=>r.value=a),items:v.value,"item-value":"id",multiple:"",chips:""},null,8,["modelValue","items"])]),_:1}),o(m,{cols:"4"},{default:i(()=>[I,o(p,{modelValue:u.value,"onUpdate:modelValue":e[2]||(e[2]=a=>u.value=a),items:w.value,multiple:"","item-value":"id",chips:""},null,8,["modelValue","items"])]),_:1}),o(m,{cols:"4"},{default:i(()=>[R,o(p,{modelValue:d.value,"onUpdate:modelValue":e[3]||(e[3]=a=>d.value=a),items:f.value,multiple:"","item-value":"id",chips:""},null,8,["modelValue","items"])]),_:1})]),_:1}),o(D,{class:"mt-10",color:"lorevera",onClick:b},{default:i(()=>[g("Save Changes")]),_:1})]))}};export{j as default};