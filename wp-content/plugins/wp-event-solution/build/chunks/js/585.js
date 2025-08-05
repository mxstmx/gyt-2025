"use strict";(globalThis.webpackChunkwp_event_solution=globalThis.webpackChunkwp_event_solution||[]).push([[585],{57770:(e,t,n)=>{n.d(t,{A:()=>i});var a=n(18537);function i(e,t){if(Array.isArray(e))return JSON.parse(JSON.stringify(e)).map((e=>(e[t]=(0,a.decodeEntities)(e[t]),e)))}},61149:(e,t,n)=>{n.d(t,{O:()=>r,f:()=>i});var a=n(69815);const i=a.default.div`
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
`,r=a.default.div`
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
`},31954:(e,t,n)=>{n.d(t,{A:()=>v});var a=n(51609),i=n(29491),r=n(47143),o=n(86087),l=n(27723),s=n(52619),c=n(60742),d=n(10012),p=n(500),g=n(64282),m=n(81585);const f=(0,r.withDispatch)((e=>{const t=e("eventin/global");return{refreshTagList:()=>t.invalidateResolution("getEventTagList")}})),u=(0,r.withSelect)((e=>{const t=e("eventin/global");return{tags:t.getEventTagList(),isLoading:t.isResolving("getEventTagList")}})),v=(0,i.compose)([u,f])((e=>{const{modalOpen:t,setModalOpen:n,refreshTagList:i,tags:r}=e,[f,u]=(0,o.useState)(!1),[v]=c.A.useForm(),{tagsData:x,setTagsData:h}=(0,o.useContext)(m.EventTagsContext)||{},b=x?.editData?.id;return(0,o.useEffect)((()=>{if(t){if(b){const{name:e,parent:t,description:n}=x?.editData;v.setFieldsValue({name:e,parent:t,description:n})}}else v.resetFields(),h&&h((e=>({...e,editData:null})))}),[t]),(0,a.createElement)(p.A,{title:(0,l.__)(b?"Edit Tag":"New Tag","eventin"),open:t,onCancel:()=>n(!1),cancelText:(0,l.__)("Cancel","eventin"),okText:b?(0,l.__)("Update Tag","eventin"):(0,l.__)("Add Tag","eventin"),onOk:async()=>{await v.validateFields(),u(!0);try{const t=v.getFieldsValue();if(b){const e=x?.editData?.id;await g.A.eventTags.updateTag(e,t),(0,s.doAction)("eventin_notification",{type:"success",message:(0,l.__)("Successfully updated the tag!","eventin")})}else{const n=await g.A.eventTags.createTag(t);if(e.form&&n?.id){const t=e.form.getFieldValue("tags",{preserve:!0})||[];e.form.setFieldsValue({tags:[n.id,...t]})}(0,s.doAction)("eventin_notification",{type:"success",message:(0,l.__)("Successfully created tag!","eventin")})}v.resetFields(),i(),n(!1)}catch(e){console.error(e.message),(0,s.doAction)("eventin_notification",{type:"error",message:e.message})}finally{u(!1)}},confirmLoading:f,destroyOnClose:!0},(0,a.createElement)(c.A,{layout:"vertical",form:v},(0,a.createElement)("div",null,(0,a.createElement)(d.ks,{name:"name",label:(0,l.__)("Tag","eventin"),placeholder:(0,l.__)("Tag Name","eventin"),size:"middle",rules:[{required:!0,message:(0,l.__)("Tag Name is Required!","eventin")}],required:!0}),(0,a.createElement)(d.No,{label:(0,l.__)("Description","eventin"),name:"description",placeholder:(0,l.__)("Tag description","eventin")}))))}))},61397:(e,t,n)=>{n.d(t,{A:()=>x});var a=n(51609),i=n(92911),r=n(11721),o=n(47767),l=n(52619),s=n(56427),c=n(27723),d=n(7638),p=n(79664),g=n(18062),m=n(27154),f=n(38224),u=n(54725),v=n(69815);function x(e){const{title:t,buttonText:n,onClickCallback:x}=e,{evnetin_ai_active:h,evnetin_pro_active:b}=window?.eventin_ai_local_data||{},E=(0,o.useNavigate)(),{pathname:w}=(0,o.useLocation)(),{doAction:_}=wp.hooks,y=["/events"!==w&&{key:"0",label:(0,c.__)("Event List","eventin"),icon:(0,a.createElement)(u.EventListIcon,{width:20,height:20}),onClick:()=>{E("/events")}},"/events/categories"!==w&&{key:"1",label:(0,c.__)("Event Categories","eventin"),icon:(0,a.createElement)(u.CategoriesIcon,null),onClick:()=>{E("/events/categories")}},"/events/tags"!==w&&{key:"2",label:(0,c.__)("Event Tags","eventin"),icon:(0,a.createElement)(u.TagIcon,null),onClick:()=>{E("/events/tags")}}],A=v.default.div`
		@media ( max-width: 460px ) {
			display: none;
		}
	`,T=(0,l.applyFilters)("eventin-ai-create-event-modal","eventin-ai");return(0,a.createElement)(s.Fill,{name:m.PRIMARY_HEADER_NAME},(0,a.createElement)(i.A,{justify:"space-between",align:"center",wrap:"wrap",gap:20},(0,a.createElement)(g.A,{title:t}),(0,a.createElement)("div",{style:{display:"flex",alignItems:"center",gap:"8px",flexWrap:"wrap"}},(0,a.createElement)(f.WO,{onClick:()=>{_(h&&b?"eventin-ai-create-event-modal-visible":"eventin-ai-text-generator-modal",{visible:!0})}},(0,a.createElement)(u.AIGenerateIcon,null),(0,a.createElement)(f.oY,null,(0,c.__)("Event with AI","eventin"))),(0,a.createElement)(d.Ay,{variant:d.zB,htmlType:"button",onClick:x,sx:{display:"flex",alignItems:"center",fontSize:"16px",fontWeight:600,borderRadius:"6px",height:"46px"}},(0,a.createElement)(u.PlusOutlined,null),n),(0,a.createElement)(i.A,{gap:12},(0,a.createElement)(r.A,{menu:{items:y},trigger:["click"],placement:"bottomRight",overlayClassName:"action-dropdown"},(0,a.createElement)(d.Ay,{variant:d.Vt,sx:{color:"#8C8C8C",height:"46px",lineHeight:"1",borderColor:"#747474",padding:"0px 13px"}},(0,a.createElement)(u.MoreIconOutlined,null))),(0,a.createElement)(A,null,(0,a.createElement)(p.A,null))))),(0,a.createElement)(T,{navigate:E,pathname:w}))}},38224:(e,t,n)=>{n.d(t,{WO:()=>o,d0:()=>r,nx:()=>i,oY:()=>l});var a=n(98869);const i=a.default.div`
	background: #f3f5f7;
	padding: 20px 0;
	min-height: calc( 100vh - 60px );
	margin-top: -20px;
`,r=a.default.div`
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
`},81585:(e,t,n)=>{n.r(t),n.d(t,{EventTagsContext:()=>g,default:()=>f});var a=n(51609),i=n(29491),r=n(47143),o=n(86087),l=n(27723),s=n(31954),c=n(61397),d=n(35632),p=n(57770);const g=(0,o.createContext)(),m=(0,r.withSelect)((e=>{const t=e("eventin/global");return{tagList:t.getEventTagList(),isLoading:t.isResolving("getEventTagList")}})),f=(0,i.compose)(m)((function(e){const{tagList:t,isLoading:n}=e;let i=(0,p.A)(t,"name");i=(0,p.A)(i,"description");const[r,m]=(0,o.useState)({filter:{parentTag:null,searchTerm:null},editData:{},isModalOpen:!1}),f=e=>{m((t=>({...t,isModalOpen:e})))};return(0,a.createElement)(g.Provider,{value:{tagsData:r,setTagsData:m}},(0,a.createElement)("div",{className:"event-tags-wrapper"},(0,a.createElement)(c.A,{title:(0,l.__)("Event Tags","eventin"),onClickCallback:()=>f(!0),buttonText:(0,l.__)("New Tag","eventin")}),(0,a.createElement)(d.A,{isLoading:n,tagList:i}),(0,a.createElement)(s.A,{modalOpen:r.isModalOpen,setModalOpen:f})))}))},12387:(e,t,n)=>{n.d(t,{A:()=>f});var a=n(51609),i=n(19549),r=n(29491),o=n(47143),l=n(52619),s=n(27723),c=n(54725),d=n(7638),p=n(64282);const{confirm:g}=i.A,m=(0,o.withDispatch)((e=>{const t=e("eventin/global");return{refreshEventTags:()=>t.invalidateResolution("getEventTagList")}})),f=(0,r.compose)(m)((function(e){const{refreshEventTags:t,record:n}=e;return(0,a.createElement)(d.Ay,{variant:d.Vt,onClick:()=>{g({title:(0,s.__)("Are you sure?","eventin"),icon:(0,a.createElement)(c.DeleteOutlinedEmpty,null),content:(0,s.__)("Are you sure you want to delete this tag?","eventin"),okText:(0,s.__)("Delete","eventin"),okButtonProps:{type:"primary",danger:!0,classNames:"delete-btn"},centered:!0,onOk:async()=>{try{await p.A.eventTags.deleteTag(n.id),t(),(0,l.doAction)("eventin_notification",{type:"success",message:(0,s.__)("Successfully deleted the tag!","eventin")})}catch(e){console.error("Error deleting tag!",e),(0,l.doAction)("eventin_notification",{type:"error",message:(0,s.__)("Failed to delete the tag!","eventin")})}},onCancel(){}})}},(0,a.createElement)(c.DeleteOutlined,{width:"16",height:"16"}))}))},35530:(e,t,n)=>{n.d(t,{A:()=>s});var a=n(51609),i=n(86087),r=n(54725),o=n(7638),l=n(81585);function s(e){const{record:t}=e,{setTagsData:n}=(0,i.useContext)(l.EventTagsContext);return(0,a.createElement)(o.Ay,{variant:o.Vt,onClick:()=>{n((e=>({...e,editData:t,isModalOpen:!0})))}},(0,a.createElement)(r.EditOutlined,{width:"16",height:"16"}))}},12:(e,t,n)=>{n.d(t,{A:()=>l});var a=n(51609),i=n(90070),r=n(12387),o=n(35530);function l(e){const{record:t}=e;return(0,a.createElement)(i.A,{size:"small",className:"event-actions"},(0,a.createElement)(o.A,{record:t}),(0,a.createElement)(r.A,{record:t}))}},61401:(e,t,n)=>{n.d(t,{A:()=>o});var a=n(51609),i=n(27723),r=n(12);window.innerWidth;const o=[{title:(0,i.__)("Tags","eventin"),dataIndex:"name",key:"name",width:250,render:e=>(0,a.createElement)("p",{className:"event-title"},e)},{title:(0,i.__)("Description","eventin"),dataIndex:"description",key:"description",render:e=>(0,a.createElement)("span",{className:"author"},e)},{title:(0,i.__)("Action","eventin"),key:"action",width:120,render:(e,t)=>(0,a.createElement)(r.A,{record:t})}]},27857:(e,t,n)=>{n.d(t,{A:()=>f});var a=n(51609),i=n(92911),r=n(79888),o=n(86087),l=n(27723),s=n(54725),c=n(79351),d=n(62215),p=n(61149),g=n(81585),m=n(64282);const f=e=>{const{selectedTags:t,setSelectedTags:n}=e,{setTagsData:f}=(0,o.useContext)(g.EventTagsContext),u=!!t?.length;return(0,a.createElement)(p.O,{className:"filter-wrapper"},(0,a.createElement)(i.A,{justify:u?"space-between":"flex-end",align:"center"},(0,a.createElement)(i.A,{justify:"start",align:"center",gap:8},u&&(0,a.createElement)(c.A,{refreshListName:"getEventTagList",selectedCount:t?.length,callbackFunction:async()=>{const e=(0,d.A)(t);await m.A.eventTags.deleteTag(e),n([])},setSelectedRows:n})),!u&&(0,a.createElement)(r.A,{className:"event-filter-by-name",placeholder:(0,l.__)("Search by tag name","eventin"),size:"default",prefix:(0,a.createElement)(s.SearchIconOutlined,null),onChange:e=>{f((t=>({...t,filter:{...t.filter,searchTerm:e.target.value}})))},allowClear:!0})))}},35632:(e,t,n)=>{n.d(t,{A:()=>m});var a=n(51609),i=n(27723),r=n(86087),o=n(75063),l=n(16784),s=n(81585),c=n(27857),d=n(61401),p=n(78387),g=n(75093);function m(e){const{tagList:t,isLoading:n}=e,[m,f]=(0,r.useState)([]),[u,v]=(0,r.useState)([]),{tagsData:x}=(0,r.useContext)(s.EventTagsContext),h={selectedRowKeys:u,onChange:e=>{v(e)}};return(0,r.useEffect)((()=>{(()=>{let e=t;x?.filter?.searchTerm&&(e=e?.filter((e=>e?.name?.toLowerCase()?.includes(x?.filter?.searchTerm?.toLowerCase())))),f(e)})()}),[t,x]),n?(0,a.createElement)(p.f,{className:"eventin-page-wrapper"},(0,a.createElement)(o.A,{active:!0})):(0,a.createElement)(p.f,{className:"eventin-page-wrapper"},(0,a.createElement)("div",{className:"event-list-wrapper"},(0,a.createElement)(c.A,{selectedTags:u,setSelectedTags:v,tags:t}),(0,a.createElement)(l.A,{className:"eventin-data-table",columns:d.A,dataSource:m,rowSelection:h,rowKey:e=>e.id,scroll:window.screen.width<668&&{x:1200},sticky:{offsetHeader:100},pagination:{showTotal:(e,t)=>(0,a.createElement)(g.CustomShowTotal,{totalCount:e,range:t,listText:(0,i.__)("tags","eventin")})}})))}},78387:(e,t,n)=>{n.d(t,{f:()=>i});var a=n(69815);const i=a.default.div`
	background-color: #f4f6fa;
	padding: 12px 32px;
	min-height: 100vh;

	.ant-table-wrapper {
		padding: 15px 30px;
		background-color: #fff;
		border-radius: 0 0 12px 12px;
	}

	.event-tags-wrapper {
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
			color: #525266;
			background-color: #f5f5f5;
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
`;a.default.div`
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
			min-height: auto;
		}
	}
`}}]);