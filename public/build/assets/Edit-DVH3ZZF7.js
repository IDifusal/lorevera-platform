import{s as m,o as I,a as r,b as c,i as l,t as k,d as a,w as n,h as U,g as q,F as E,j as v,v as g,x as d,G as f,k as _,p as h,n as F,f as S}from"./app-B8AjFgFC.js";import{u as B,S as N,E as R}from"./index-CWzamQ59.js";import{U as T}from"./UploadVideo-3ZKbNGGo.js";import{U as D}from"./UploadImage-DWVXEc4u.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const M={class:"form-group"},$=l("label",{for:"quantity"},"Name:",-1),j=l("label",{for:"quantity"},"Reps:",-1),G=l("label",{for:"quantity"},"Sets:",-1),H=l("label",{for:"Content"},"Content:",-1),K=l("label",{for:"quantity"},"Image:",-1),L=["src"],W=l("label",{for:"video"},"Video:",-1),Y=l("br",null,null,-1),z={key:0,width:"350",controls:""},A=["src"],ee={__name:"Edit",setup(J){const V=S(),t=m({}),u=m(null),i=m(null),w=s=>{console.log(s),i.value=s[0]},y=()=>{i.value=null},b=s=>{u.value=s[0]},C=()=>{u.value=null},p=B({content:"<p>Content <strong> add here</strong></p>",extensions:[N]}),x=async()=>{const s=window.location.pathname.split("/").pop();if(!t.value.name||!t.value.reps||!t.value.sets)return;const e=new FormData;e.append("name",t.value.name),e.append("reps",t.value.reps),e.append("sets",t.value.sets),e.append("content",p.value.getHTML()),u.value&&e.append("image",u.value),i.value&&e.append("video",i.value);try{const o=await axios.post(`/api/web/update-warmup/${s}`,e,{headers:{"Content-Type":"multipart/form-data"}});console.log(o),V.push({name:"warm-up-list"})}catch(o){console.log(o)}};return I(async()=>{console.log("mounted");const s=window.location.pathname.split("/").pop();try{const{data:e}=await axios.get(`/api/web/list-warmup/${s}`);t.value=e,p.value.commands.setContent(e.description)}catch(e){console.log(e)}}),(s,e)=>(r(),c(E,null,[l("h2",null,"Editing Workout "+k(t.value.name),1),l("div",M,[a(q,{ref:"form","fast-fail":"",onSubmit:e[3]||(e[3]=U(o=>x(),["prevent"]))},{default:n(()=>[$,a(v,{modelValue:t.value.name,"onUpdate:modelValue":e[0]||(e[0]=o=>t.value.name=o),"hide-details":"","single-line":"",rules:[o=>!!o||"Item is required"]},null,8,["modelValue","rules"]),a(g,{align:"start","no-gutters":"",ga:""},{default:n(()=>[a(d,{class:"mr-5"},{default:n(()=>[j,a(v,{modelValue:t.value.reps,"onUpdate:modelValue":e[1]||(e[1]=o=>t.value.reps=o),"hide-details":"","single-line":"",rules:[o=>!!o||"Reps is required"],type:"number"},null,8,["modelValue","rules"])]),_:1}),a(d,null,{default:n(()=>[G,a(v,{modelValue:t.value.sets,"onUpdate:modelValue":e[2]||(e[2]=o=>t.value.sets=o),"hide-details":"","single-line":"",rules:[o=>!!o||"Item is required"],type:"number"},null,8,["modelValue","rules"])]),_:1})]),_:1}),H,a(f(R),{editor:f(p)},null,8,["editor"]),a(g,null,{default:n(()=>[a(d,null,{default:n(()=>[K,t.value.image_url?(r(),c("img",{key:0,src:"/storage/"+t.value.image_url,alt:"",style:{width:"80px",height:"80px","object-fit":"contain"}},null,8,L)):(r(),_(D,{key:1,onCleanImg:C,onChanged:b}))]),_:1}),a(d,null,{default:n(()=>[W,Y,t.value.video_url?(r(),c("video",z,[l("source",{src:"/storage/"+t.value.video_url,type:"video/mp4"},null,8,A),h(" Your browser does not support the video tag. ")])):(r(),_(T,{key:1,onCleanImg:y,onChanged:w}))]),_:1})]),_:1}),a(F,{class:"mt-10",color:"lorevera",type:"submit"},{default:n(()=>[h("Save Changes")]),_:1})]),_:1},512)])],64))}};export{ee as default};