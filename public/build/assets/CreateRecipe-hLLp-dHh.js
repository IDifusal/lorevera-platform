import{U as j}from"./UploadImage-i_V0JoWh.js";import{_ as F}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{c as M,w as l,r as d,o as T,b as i,t as f,d as e,e as n,m as q,p as P}from"./app-DouUbhVd.js";const B={components:{UploadImage:j},data:()=>({dialog:!1,dialogDelete:!1,plan:{name:""},rules:{required:t=>!!t||"Required Field."},headers:[{text:"Meal Name",align:"start",sortable:!1,value:"name"},{text:"Calories",value:"calories"},{text:"Fat (g)",value:"fat"},{text:"Carbs (g)",value:"carbs"},{text:"Protein (g)",value:"protein"},{text:"Actions",value:"actions",sortable:!1}],desserts:[],editedIndex:-1,editedItem:{name:"",calories:0,fat:0,carbs:0,protein:0},defaultItem:{name:"",calories:0,fat:0,carbs:0,protein:0}}),computed:{formTitle(){return this.editedIndex===-1?"New Meal":"Edit Meal"}},watch:{dialog(t){t||this.close()},dialogDelete(t){t||this.closeDelete()}},methods:{onFileChange(t){this.plan.photo=t[0]},clearImg(){this.plan.photo=null},editItem(t){this.editedIndex=this.desserts.indexOf(t),this.editedItem=Object.assign({},t),this.dialog=!0},deleteItem(t){this.editedIndex=this.desserts.indexOf(t),this.editedItem=Object.assign({},t),this.dialogDelete=!0},deleteItemConfirm(){this.desserts.splice(this.editedIndex,1),this.closeDelete()},close(){this.dialog=!1,this.$nextTick(()=>{this.editedItem=Object.assign({},this.defaultItem),this.editedIndex=-1})},closeDelete(){this.dialogDelete=!1,this.$nextTick(()=>{this.editedItem=Object.assign({},this.defaultItem),this.editedIndex=-1})},save(){this.editedIndex>-1?Object.assign(this.desserts[this.editedIndex],this.editedItem):this.desserts.push(this.editedItem),this.close()}}},A=i("h4",null,"Name",-1),R=i("h4",null,"Image",-1),S={class:"text-h5"},E=i("h4",{class:"mt-3"},"Ingredients",-1),H=i("h4",{class:"mt-3"},"Instructions",-1);function K(t,o,z,G,J,s){const m=d("v-text-field"),C=d("upload-image"),r=d("v-col"),p=d("v-row"),k=d("v-toolbar-title"),w=d("v-divider"),c=d("v-spacer"),u=d("v-btn"),v=d("v-card-title"),I=d("wysiwyg"),x=d("v-container"),U=d("v-card-text"),g=d("v-card-actions"),h=d("v-card"),b=d("v-dialog"),D=d("v-toolbar"),V=d("v-icon"),y=d("v-data-table"),N=d("v-form"),O=d("v-main");return T(),M(O,null,{default:l(()=>[i("h3",null,"Creating Nutrition Plan: "+f(t.plan.name),1),A,e(N,null,{default:l(()=>[e(m,{modelValue:t.plan.name,"onUpdate:modelValue":o[0]||(o[0]=a=>t.plan.name=a),rules:[t.rules.required],class:"field",required:"",flat:""},null,8,["modelValue","rules"]),e(p,null,{default:l(()=>[e(r,{cols:"6"},{default:l(()=>[R,i("div",null,[e(C,{onCleanImg:s.clearImg,onChanged:s.onFileChange,max:1},null,8,["onCleanImg","onChanged"])])]),_:1})]),_:1}),e(y,{headers:t.headers,items:t.desserts,"sort-by":"calories",class:"elevation-1 mt-5"},{top:l(()=>[e(D,{flat:""},{default:l(()=>[e(k,null,{default:l(()=>[n("Meals")]),_:1}),e(w,{class:"mx-4",inset:"",vertical:""}),e(c),e(b,{modelValue:t.dialog,"onUpdate:modelValue":o[8]||(o[8]=a=>t.dialog=a),width:"700px"},{activator:l(({on:a,attrs:_})=>[e(u,q({color:"primary",dark:"",class:"mb-2"},_,P(a)),{default:l(()=>[n(" New Item ")]),_:2},1040)]),default:l(()=>[e(h,null,{default:l(()=>[e(v,null,{default:l(()=>[i("span",S,f(s.formTitle)+": "+f(t.editedItem.name),1)]),_:1}),e(U,null,{default:l(()=>[e(x,null,{default:l(()=>[e(p,null,{default:l(()=>[e(r,{cols:"12",sm:"6",md:"4"},{default:l(()=>[e(m,{modelValue:t.editedItem.name,"onUpdate:modelValue":o[1]||(o[1]=a=>t.editedItem.name=a),label:"Meal name"},null,8,["modelValue"])]),_:1}),e(r,{cols:"12",sm:"6",md:"4"},{default:l(()=>[e(m,{modelValue:t.editedItem.calories,"onUpdate:modelValue":o[2]||(o[2]=a=>t.editedItem.calories=a),label:"Calories"},null,8,["modelValue"])]),_:1}),e(r,{cols:"12",sm:"6",md:"4"},{default:l(()=>[e(m,{modelValue:t.editedItem.fat,"onUpdate:modelValue":o[3]||(o[3]=a=>t.editedItem.fat=a),label:"Fat (g)"},null,8,["modelValue"])]),_:1}),e(r,{cols:"12",sm:"6",md:"4"},{default:l(()=>[e(m,{modelValue:t.editedItem.carbs,"onUpdate:modelValue":o[4]||(o[4]=a=>t.editedItem.carbs=a),label:"Carbs (g)"},null,8,["modelValue"])]),_:1}),e(r,{cols:"12",sm:"6",md:"4"},{default:l(()=>[e(m,{modelValue:t.editedItem.protein,"onUpdate:modelValue":o[5]||(o[5]=a=>t.editedItem.protein=a),label:"Protein (g)"},null,8,["modelValue"])]),_:1})]),_:1}),E,e(I,{modelValue:t.editedItem.ingredients,"onUpdate:modelValue":o[6]||(o[6]=a=>t.editedItem.ingredients=a)},null,8,["modelValue"]),H,e(I,{modelValue:t.editedItem.instructions,"onUpdate:modelValue":o[7]||(o[7]=a=>t.editedItem.instructions=a)},null,8,["modelValue"])]),_:1})]),_:1}),e(g,null,{default:l(()=>[e(c),e(u,{color:"blue darken-1",text:"",onClick:s.close},{default:l(()=>[n(" Cancel ")]),_:1},8,["onClick"]),e(u,{color:"blue darken-1",text:"",onClick:s.save},{default:l(()=>[n(" Save ")]),_:1},8,["onClick"])]),_:1})]),_:1})]),_:1},8,["modelValue"]),e(b,{modelValue:t.dialogDelete,"onUpdate:modelValue":o[9]||(o[9]=a=>t.dialogDelete=a),"max-width":"500px"},{default:l(()=>[e(h,null,{default:l(()=>[e(v,{class:"text-h5"},{default:l(()=>[n("Are you sure you want to delete this item?")]),_:1}),e(g,null,{default:l(()=>[e(c),e(u,{color:"blue darken-1",text:"",onClick:s.closeDelete},{default:l(()=>[n("Cancel")]),_:1},8,["onClick"]),e(u,{color:"blue darken-1",text:"",onClick:s.deleteItemConfirm},{default:l(()=>[n("OK")]),_:1},8,["onClick"]),e(c)]),_:1})]),_:1})]),_:1},8,["modelValue"])]),_:1})]),"item.actions":l(({item:a})=>[e(V,{small:"",class:"mr-2",onClick:_=>s.editItem(a)},{default:l(()=>[n(" mdi-pencil ")]),_:2},1032,["onClick"]),e(V,{small:"",onClick:_=>s.deleteItem(a)},{default:l(()=>[n(" mdi-delete ")]),_:2},1032,["onClick"])]),"no-data":l(()=>[n(" No items ")]),_:1},8,["headers","items"])]),_:1})]),_:1})}const X=F(B,[["render",K]]);export{X as default};
