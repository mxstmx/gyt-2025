(globalThis.webpackChunkwp_event_solution=globalThis.webpackChunkwp_event_solution||[]).push([[702],{57770:(e,t,n)=>{"use strict";n.d(t,{A:()=>r});var a=n(18537);function r(e,t){if(Array.isArray(e))return JSON.parse(JSON.stringify(e)).map((e=>(e[t]=(0,a.decodeEntities)(e[t]),e)))}},59985:(e,t,n)=>{"use strict";n.d(t,{A:()=>u});var a=n(51609),r=n(19549),i=n(29491),o=n(47143),l=n(52619),s=n(27723),c=n(54725),d=n(7638),g=n(64282);const{confirm:p}=r.A,m=(0,o.withDispatch)((e=>{const t=e("eventin/global");return{refreshEventCategories:()=>t.invalidateResolution("getEventCategories")}})),u=(0,i.compose)(m)((function(e){const{refreshEventCategories:t,record:n}=e;return(0,a.createElement)(d.Ay,{variant:d.Vt,onClick:()=>{p({title:(0,s.__)("Are you sure?","eventin"),icon:(0,a.createElement)(c.DeleteOutlinedEmpty,null),content:(0,s.__)("Are you sure you want to delete this event?","eventin"),okText:(0,s.__)("Delete","eventin"),okButtonProps:{type:"primary",danger:!0,classNames:"delete-btn"},centered:!0,onOk:async()=>{try{await g.A.eventCategories.deleteCategory(n.id),t(),(0,l.doAction)("eventin_notification",{type:"success",message:(0,s.__)("Successfully deleted the category!","eventin")})}catch(e){console.error("Error deleting category",e),(0,l.doAction)("eventin_notification",{type:"error",message:(0,s.__)("Failed to delete the category!","eventin")})}},onCancel(){}})}},(0,a.createElement)(c.DeleteOutlined,{width:"16",height:"16"}))}))},70696:(e,t,n)=>{"use strict";n.d(t,{A:()=>s});var a=n(51609),r=n(86087),i=n(54725),o=n(7638),l=n(54702);function s(e){const{record:t}=e,{setCategoriesData:n}=(0,r.useContext)(l.EventCategoryContext);return(0,a.createElement)(o.Ay,{variant:o.Vt,onClick:()=>{n((e=>({...e,editData:t,isModalOpen:!0})))}},(0,a.createElement)(i.EditOutlined,{width:"16",height:"16"}))}},77914:(e,t,n)=>{"use strict";n.d(t,{A:()=>l});var a=n(51609),r=n(90070),i=n(59985),o=n(70696);function l(e){const{record:t}=e;return(0,a.createElement)(r.A,{size:"small",className:"event-actions"},(0,a.createElement)(o.A,{record:t}),(0,a.createElement)(i.A,{record:t}))}},20124:(e,t,n)=>{"use strict";n.d(t,{A:()=>i});var a=n(51609),r=n(90070);function i(e){const{record:t}=e;return(0,a.createElement)(r.A,{size:"small",align:"center"},(0,a.createElement)("div",{style:{width:"12px",height:"12px",borderRadius:"50%",aspectRatio:"1",backgroundColor:t.color||"#ff4d4f",display:"inline-block"}}),(0,a.createElement)("span",null,t.name))}},69607:(e,t,n)=>{"use strict";n.d(t,{A:()=>l});var a=n(51609),r=n(27723),i=n(77914),o=n(20124);const l=[{title:(0,r.__)("Category","eventin"),dataIndex:"name",key:"name",width:330,render:(e,t)=>(0,a.createElement)(o.A,{record:t})},{title:(0,r.__)("Parent Category","eventin"),key:"parent",dataIndex:"parent_name",render:e=>(0,a.createElement)("span",{className:"author"},e||"-")},{title:(0,r.__)("Description","eventin"),dataIndex:"description",key:"description",render:e=>(0,a.createElement)("span",{className:"author"},e||"-")},{title:(0,r.__)("Action","eventin"),key:"action",width:120,render:(e,t)=>(0,a.createElement)(i.A,{record:t})}]},6371:(e,t,n)=>{"use strict";n.d(t,{A:()=>x});var a=n(51609),r=n(92911),i=n(36492),o=n(79888),l=n(29491),s=n(47143),c=n(86087),d=n(27723),g=n(54725),p=n(79351),m=n(62215),u=n(61149),v=n(64282),f=n(54702);const h=(0,s.withSelect)((e=>({categories:e("eventin/global").getEventCategories()}))),x=(0,l.compose)(h)((e=>{const{selectedCategories:t,setSelectedCategories:n,categories:l}=e,{setCategoriesData:s}=(0,c.useContext)(f.EventCategoryContext),h=!!t?.length;return(0,a.createElement)(u.O,{className:"filter-wrapper"},(0,a.createElement)(r.A,{justify:"space-between",wrap:"wrap",align:"center",gap:8},(0,a.createElement)(r.A,{justify:"start",align:"center",gap:8},h?(0,a.createElement)(p.A,{refreshListName:"getEventCategories",selectedCount:t?.length,callbackFunction:async()=>{const e=(0,m.A)(t);await v.A.eventCategories.deleteCategory(e),n([])},setSelectedRows:n}):(0,a.createElement)(i.A,{placeholder:(0,d.__)("Parent Category","eventin"),options:l||[],size:"default",style:{minWidth:"200px",width:"100%"},fieldNames:{label:"name",value:"id"},onChange:e=>{s((t=>({...t,filter:{...t.filter,parentCategory:e}})))},allowClear:!0})),!h&&(0,a.createElement)(o.A,{style:{minWidth:"100px"},className:"event-filter-by-name",placeholder:(0,d.__)("Search by category name","eventin"),size:"default",prefix:(0,a.createElement)(g.SearchIconOutlined,null),onChange:e=>{s((t=>({...t,filter:{...t.filter,searchTerm:e.target.value}})))},allowClear:!0})))}))},33394:(e,t,n)=>{"use strict";n.d(t,{A:()=>y});var a=n(51609),r=n(86087),i=n(75063),o=n(16784),l=n(74353),s=n.n(l),c=n(98867),d=n.n(c),g=n(8906),p=n.n(g),m=n(27723),u=n(54702),v=n(6371),f=n(69607),h=n(61149),x=n(75093);function y(e){const{categoryList:t,isLoading:n}=e,[l,s]=(0,r.useState)([]),[c,d]=(0,r.useState)([]),{categoriesData:g}=(0,r.useContext)(u.EventCategoryContext),p={selectedRowKeys:c,onChange:e=>{d(e)}};return(0,r.useEffect)((()=>{(()=>{let e=t;g?.filter?.parentCategory&&(e=e?.filter((e=>e?.parent===g?.filter?.parentCategory))),g?.filter?.searchTerm&&(e=e?.filter((e=>e?.name?.toLowerCase()?.includes(g?.filter?.searchTerm?.toLowerCase())))),s(e)})()}),[t,g]),n?(0,a.createElement)(h.f,{className:"eventin-page-wrapper"},(0,a.createElement)(i.A,{active:!0})):(0,a.createElement)(h.f,{className:"eventin-page-wrapper"},(0,a.createElement)("div",{className:"event-list-wrapper"},(0,a.createElement)(v.A,{selectedCategories:c,setSelectedCategories:d,categories:t}),(0,a.createElement)(o.A,{className:"eventin-data-table",columns:f.A,dataSource:l,rowSelection:p,rowKey:e=>e.id,scroll:{x:800},sticky:{offsetHeader:100},pagination:{showTotal:(e,t)=>(0,a.createElement)(x.CustomShowTotal,{totalCount:e,range:t,listText:(0,m.__)("categories","eventin")})}})))}s().extend(d()),s().extend(p())},61149:(e,t,n)=>{"use strict";n.d(t,{O:()=>i,f:()=>r});var a=n(69815);const r=a.default.div`
	background-color: #f4f6fa;
	padding: 12px 32px;
	min-height: 100vh;

	.ant-table-wrapper {
		padding: 15px 30px;
		background-color: #fff;
		border-radius: 0 0 12px 12px;
	}

	.event-categories-wrapper {
		border-radius: 0 0 12px 12px;
	}

	.ant-table-thead {
		> tr {
			> th {
				background-color: #fff;
				padding-top: 10px;
				font-weight: 500;
				color: #7a7a99;
				&:before {
					display: none;
				}
			}
		}
	}

	.event-title {
		color: #262626;
		font-size: 16px;
		font-weight: 400;
		line-height: 24px;
		display: inline-flex;
		margin-bottom: 6px;
	}

	.event-location,
	.event-date-time {
		color: #858585;
		margin: 0;
		line-height: 1.4;
		font-size: 14px;
	}
	.event-date-time {
		display: flex;
		align-items: center;
		gap: 4px;
	}

	.event-location {
		margin-bottom: 4px;
	}

	.event-actions {
		.ant-btn {
			padding: 0;
			width: 28px;
			height: 28px;
			line-height: 1;
			display: flex;
			justify-content: center;
			align-items: center;
			border-color: #c9c9c9;
			color: ##525266;
			background-color: ##f5f5f5;
		}
	}

	.ant-tag {
		border-radius: 20px;
		font-size: 12px;
		font-weight: 400;
		padding: 4px 13px;
		min-width: 80px;
		text-align: center;
	}

	.ant-tag.event-category {
		background-color: transparent;
		font-size: 1rem;
		color: #181818;
		padding: 0;
		text-align: left;
	}

	.author {
		color: #181818;
		font-size: 1rem;
		text-transform: capitalize;
	}
`,i=a.default.div`
	padding: 22px 36px;
	background: #fff;
	border-radius: 12px 12px 0 0;
	border-bottom: 1px solid #ddd;

	.ant-form-item {
		margin-bottom: 0;
	}
	.ant-select-single {
		height: 36px;
		width: 120px !important;
	}

	.ant-picker {
		height: 36px;
	}
	.event-filter-by-name {
		height: 36px;
		border: 1px solid #ddd;
		max-width: 250px;

		input.ant-input {
			min-height: 32px !important;
		}
	}
`},77803:(e,t,n)=>{"use strict";n.d(t,{A:()=>m});var a=n(51609),r=n(27723),i=n(67313),o=n(90070),l=n(92911),s=n(29392),c=n(5556),d=n.n(c);const{Text:g}=i.A,p=["#FF4D4F","#FF7A45","#FFA940","#52C41A","#13C2C2","#1677FF","#722ED1","#EB2F96","#595959","#8C8C8C"];function m({value:e,onChange:t}){return(0,a.createElement)(o.A,{direction:"vertical",size:12,style:{width:"100%"}},(0,a.createElement)(g,{strong:!0},(0,r.__)("Category Color","eventin")),(0,a.createElement)(l.A,{gap:8,wrap:"wrap"},p.map((n=>(0,a.createElement)("div",{key:n,onClick:()=>t(n),style:{width:24,height:24,borderRadius:4,backgroundColor:n,cursor:"pointer",border:e===n?"2px solid #1677FF":"none"}})))),(0,a.createElement)("div",{className:"category-color-picker-scop"},(0,a.createElement)(s.A,{size:"large",showText:!0,value:e,onChange:e=>t(e.toHexString()),presets:[{label:(0,r.__)("Recommended","eventin"),colors:p}],getPopupContainer:()=>document.querySelector(".category-color-picker-scop")})))}m.propTypes={value:d().string,onChange:d().func.isRequired}},54702:(e,t,n)=>{"use strict";n.r(t),n.d(t,{EventCategoryContext:()=>p,default:()=>u});var a=n(51609),r=n(29491),i=n(47143),o=n(86087),l=n(27723),s=n(57770),c=n(70034),d=n(61397),g=n(33394);const p=(0,o.createContext)(),m=(0,i.withSelect)((e=>{const t=e("eventin/global");return{categoryList:t.getEventCategories(),isLoading:t.isResolving("getEventCategories")}})),u=(0,r.compose)(m)((function(e){const{categoryList:t,isLoading:n}=e;let r=(0,s.A)(t,"name");r=(0,s.A)(r,"description");const[i,m]=(0,o.useState)({filter:{parentCategory:null,searchTerm:null},editData:{},isModalOpen:!1}),u=e=>{m((t=>({...t,isModalOpen:e})))};return(0,a.createElement)(p.Provider,{value:{categoriesData:i,setCategoriesData:m}},(0,a.createElement)("div",{className:"event-categories-wrapper eventin-event-categories-wrapper"},(0,a.createElement)(d.A,{title:(0,l.__)("Event Categories","eventin"),onClickCallback:()=>u(!0),buttonText:(0,l.__)("New Category","eventin")}),(0,a.createElement)(g.A,{isLoading:n,categoryList:r}),(0,a.createElement)(c.A,{modalOpen:i.isModalOpen,setModalOpen:u})))}))},70034:(e,t,n)=>{"use strict";n.d(t,{A:()=>y});var a=n(51609),r=n(29491),i=n(47143),o=n(86087),l=n(52619),s=n(27723),c=n(60742),d=n(36492),g=n(77803),p=n(500),m=n(10012),u=n(54702),v=n(64282);const f=(0,l.applyFilters)("eventin-category-meta",(()=>null)),h=(0,i.withDispatch)((e=>{const t=e("eventin/global");return{refreshCategoryList:()=>t.invalidateResolution("getEventCategories")}})),x=(0,i.withSelect)((e=>{const t=e("eventin/global");return{categories:t.getEventCategories(),isLoading:t.isResolving("getEventCategories")}})),y=(0,r.compose)([x,h])((e=>{const{modalOpen:t,setModalOpen:n,refreshCategoryList:r,categories:i}=e,[h,x]=(0,o.useState)(!1),[y]=c.A.useForm(),{categoriesData:C,setCategoriesData:E}=(0,o.useContext)(u.EventCategoryContext)||{},_=C?.editData?.id;return(0,o.useEffect)((()=>{if(t){if(_){const e=C?.editData,t=e?.parent;y.setFieldsValue({...e,parent:0===parseInt(t)?null:t})}}else y.resetFields(),E&&E((e=>({...e,editData:null})))}),[t]),(0,a.createElement)(p.A,{title:(0,s.__)(_?"Edit Category":"New Category","eventin"),open:t,onCancel:()=>{n(!1)},cancelText:(0,s.__)("Cancel","eventin"),okText:_?(0,s.__)("Update Category","eventin"):(0,s.__)("Add Category","eventin"),onOk:async()=>{await y.validateFields(),x(!0);try{const t=y.getFieldsValue(!0);if(_){const e=C?.editData?.id;await v.A.eventCategories.updateCategory(e,t),(0,l.doAction)("eventin_notification",{type:"success",message:(0,s.__)("Successfully updated the category!","eventin")})}else{const n=await v.A.eventCategories.createCategory(t);if(e?.form&&n?.id){const t=e?.form?.getFieldValue("categories",{preserve:!0})||[];e?.form?.setFieldsValue({categories:[...t,n.id]})}(0,l.doAction)("eventin_notification",{type:"success",message:(0,s.__)("Successfully created category!","eventin")})}y.resetFields(),r(),n(!1)}catch(e){console.error("Couldn't Create Category"),console.error(e.message)}finally{x(!1)}},confirmLoading:h,destroyOnClose:!0,maskClosable:!1},(0,a.createElement)(c.A,{layout:"vertical",form:y},(0,a.createElement)("div",null,(0,a.createElement)(m.ks,{placeholder:"Category",name:"name",label:(0,s.__)("Category Name","eventin"),size:"middle",rules:[{required:!0,message:(0,s.__)("Category Name is Required!","eventin")}],required:!0}),(0,a.createElement)(c.A.Item,{name:"parent",label:(0,s.__)("Parent Category","eventin")},(0,a.createElement)(d.A,{options:i||[],size:"large",placeholder:(0,s.__)("Select Parent Category (if any)","eventin"),fieldNames:{value:"id",label:"name"}})),(0,a.createElement)(f,{form:y}),(0,a.createElement)(c.A.Item,{name:"color",style:{marginBottom:"24px"}},(0,a.createElement)(g.A,null)),(0,a.createElement)(m.No,{className:"event-category-description",label:(0,s.__)("Description","eventin"),name:"description",placeholder:(0,s.__)("Category description","eventin")}))))}))},61397:(e,t,n)=>{"use strict";n.d(t,{A:()=>h});var a=n(51609),r=n(92911),i=n(11721),o=n(47767),l=n(52619),s=n(56427),c=n(27723),d=n(7638),g=n(79664),p=n(18062),m=n(27154),u=n(38224),v=n(54725),f=n(69815);function h(e){const{title:t,buttonText:n,onClickCallback:h}=e,{evnetin_ai_active:x,evnetin_pro_active:y}=window?.eventin_ai_local_data||{},C=(0,o.useNavigate)(),{pathname:E}=(0,o.useLocation)(),{doAction:_}=wp.hooks,b=["/events"!==E&&{key:"0",label:(0,c.__)("Event List","eventin"),icon:(0,a.createElement)(v.EventListIcon,{width:20,height:20}),onClick:()=>{C("/events")}},"/events/categories"!==E&&{key:"1",label:(0,c.__)("Event Categories","eventin"),icon:(0,a.createElement)(v.CategoriesIcon,null),onClick:()=>{C("/events/categories")}},"/events/tags"!==E&&{key:"2",label:(0,c.__)("Event Tags","eventin"),icon:(0,a.createElement)(v.TagIcon,null),onClick:()=>{C("/events/tags")}}],A=f.default.div`
		@media ( max-width: 460px ) {
			display: none;
		}
	`,w=(0,l.applyFilters)("eventin-ai-create-event-modal","eventin-ai");return(0,a.createElement)(s.Fill,{name:m.PRIMARY_HEADER_NAME},(0,a.createElement)(r.A,{justify:"space-between",align:"center",wrap:"wrap",gap:20},(0,a.createElement)(p.A,{title:t}),(0,a.createElement)("div",{style:{display:"flex",alignItems:"center",gap:"8px",flexWrap:"wrap"}},(0,a.createElement)(u.WO,{onClick:()=>{_(x&&y?"eventin-ai-create-event-modal-visible":"eventin-ai-text-generator-modal",{visible:!0})}},(0,a.createElement)(v.AIGenerateIcon,null),(0,a.createElement)(u.oY,null,(0,c.__)("Event with AI","eventin"))),(0,a.createElement)(d.Ay,{variant:d.zB,htmlType:"button",onClick:h,sx:{display:"flex",alignItems:"center",fontSize:"16px",fontWeight:600,borderRadius:"6px",height:"46px"}},(0,a.createElement)(v.PlusOutlined,null),n),(0,a.createElement)(r.A,{gap:12},(0,a.createElement)(i.A,{menu:{items:b},trigger:["click"],placement:"bottomRight",overlayClassName:"action-dropdown"},(0,a.createElement)(d.Ay,{variant:d.Vt,sx:{color:"#8C8C8C",height:"46px",lineHeight:"1",borderColor:"#747474",padding:"0px 13px"}},(0,a.createElement)(v.MoreIconOutlined,null))),(0,a.createElement)(A,null,(0,a.createElement)(g.A,null))))),(0,a.createElement)(w,{navigate:C,pathname:E}))}},38224:(e,t,n)=>{"use strict";n.d(t,{WO:()=>o,d0:()=>i,nx:()=>r,oY:()=>l});var a=n(98869);const r=a.default.div`
	background: #f3f5f7;
	padding: 20px 0;
	min-height: calc( 100vh - 60px );
	margin-top: -20px;
`,i=a.default.div`
	background: #ffffff;
	border: 1px solid #e1e4e9;
	border-radius: 8px;
	margin: 40px;
	padding: 40px;
	@media screen and ( max-width: 1350px ) and ( min-width: 1200px ) {
		margin: 20px;
		padding: 20px 0px;
	}
	@media ( max-width: 768px ) {
		padding: 20px;
		margin: 0px;
	}
`,o=a.default.button`
	display: flex;
	align-items: center;
	height: 46px;
	gap: 8px;
	padding: 8px 16px;
	font-size: 16px;
	font-weight: 500;
	background: #f9f5ff;
	border: none;
	border-radius: 6px;
	cursor: pointer;
	position: relative;
	transition: all 0.2s ease;
	svg {
		color: #ff69b4;
	}
`,l=a.default.span`
	background: linear-gradient(
		90deg,
		#fc8327 0%,
		#e83aa5 50.5%,
		#3a4ff2 100%
	);
	-webkit-background-clip: text;
	-webkit-text-fill-color: rgba( 0, 0, 0, 0 );
	background-clip: text;
`},98867:function(e){e.exports=function(){"use strict";return function(e,t){t.prototype.isSameOrAfter=function(e,t){return this.isSame(e,t)||this.isAfter(e,t)}}}()},8906:function(e){e.exports=function(){"use strict";return function(e,t){t.prototype.isSameOrBefore=function(e,t){return this.isSame(e,t)||this.isBefore(e,t)}}}()}}]);