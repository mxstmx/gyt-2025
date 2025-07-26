"use strict";(globalThis.webpackChunkwp_event_solution=globalThis.webpackChunkwp_event_solution||[]).push([[407,981],{57770:(e,t,n)=>{n.d(t,{A:()=>r});var a=n(18537);function r(e,t){if(Array.isArray(e))return JSON.parse(JSON.stringify(e)).map((e=>(e[t]=(0,a.decodeEntities)(e[t]),e)))}},61149:(e,t,n)=>{n.d(t,{O:()=>i,f:()=>r});var a=n(69815);const r=a.default.div`
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
`},71819:(e,t,n)=>{n.d(t,{A:()=>b});var a=n(51609),r=n(29491),i=n(47143),o=n(86087),l=n(27723),s=n(47152),c=n(16370),d=n(60742),p=n(36492),m=n(92911),u=n(32099),g=n(38181),f=n(54725),v=n(7638),h=n(3606),x=n(13444),_=n(16032),E=n(10012),y=n(91807),A=n(23985);const k=(0,i.withSelect)((e=>{const t=e("eventin/global");return{speakerCategories:t.getSpeakerCategories(),isLoading:t.isResolving("getSpeakerCategories")}})),b=(0,r.compose)(k)((e=>{const{form:t,speakerCategories:n}=e,[r,i]=(0,o.useState)(!1);return(0,a.createElement)(a.Fragment,null,(0,a.createElement)(s.A,{gutter:[16,0]},(0,a.createElement)(c.A,{xs:24,md:12},(0,a.createElement)(E.ks,{label:(0,l.__)("Full Name","eventin"),name:"name",rules:[{required:!0,message:(0,l.__)("Full name is required!","eventin")}],required:!0,placeholder:(0,l.__)("Write Full Name","eventin"),size:"large",tooltip:(0,l.__)("Please enter full name of speaker/organizer","eventin")})),(0,a.createElement)(c.A,{xs:24,md:12},(0,a.createElement)(E.ks,{label:(0,l.__)("Email Address","eventin"),name:"email",required:!0,rules:[{type:"email",required:!0,message:(0,l.__)("Please enter valid email address","eventin")}],placeholder:(0,l.__)("Write Email Address","eventin"),size:"large",tooltip:(0,l.__)("Please enter email address of speaker/organizer","eventin")})),(0,a.createElement)(c.A,{xs:24,md:12},(0,a.createElement)(d.A.Item,{label:(0,l.__)("Role","eventin"),name:"category",style:{width:"100%"},rules:[{required:!0,message:(0,l.__)("You must choose a Roll","eventin")}],tooltip:(0,l.__)("Select a role of speaker/organizer","eventin")},(0,a.createElement)(p.A,{options:w,placeholder:(0,l.__)("Select Role","eventin"),size:"large",mode:"multiple",showSearch:!1}))),(0,a.createElement)(c.A,{xs:24,md:12},(0,a.createElement)(d.A.Item,{label:(0,l.__)("Category","eventin"),name:"speaker_group",style:{width:"100%"},tooltip:(0,l.__)("Select a group category of speaker/organizer","eventin")},(0,a.createElement)(x.A,{placeholder:(0,l.__)("Select a group category","eventin"),options:n,fieldNames:{value:"id",label:"name"},mode:"multiple",maxTagCount:"responsive"},(0,a.createElement)(v.yl,{onClick:()=>i(!0)},(0,l.__)("Add New","eventin"))))),(0,a.createElement)(c.A,{xs:24,md:24},(0,a.createElement)(h.A,{name:"summary",label:(0,l.__)("Bio","eventin"),form:t,sx:{height:"150px",marginBottom:"50px"}})),(0,a.createElement)(c.A,{xs:24,md:12},(0,a.createElement)(E.ks,{label:(0,l.__)("Job Title","eventin"),name:"designation",placeholder:(0,l.__)("Write Job Title","eventin"),size:"large"})),(0,a.createElement)(c.A,{xs:24,md:12},(0,a.createElement)(E.ks,{label:(0,l.__)("Company Name","eventin"),name:"company_name",placeholder:(0,l.__)("Enter Company Name","eventin"),size:"large"})),(0,a.createElement)(c.A,{xs:24},(0,a.createElement)(E.ks,{label:(0,l.__)("Company URL","eventin"),name:"company_url",placeholder:(0,l.__)("Enter Company URL","eventin"),size:"large",rules:[{type:"url",message:(0,l.__)("Please enter a valid URL!","eventin")}]}))),(0,a.createElement)(s.A,{gutter:[16,0]},(0,a.createElement)(c.A,{xs:24,md:8},(0,a.createElement)(d.A.Item,{label:(0,l.__)("Photo","eventin"),name:"image",tooltip:(0,l.__)("Upload photo","eventin")},(0,a.createElement)(y.ng,{form:t,name:"image",buttonText:(0,l.__)("Upload Photo","eventin")}))),(0,a.createElement)(c.A,{xs:24,md:8},(0,a.createElement)(d.A.Item,{label:(0,l.__)("Company logo","eventin"),name:"company_logo",tooltip:(0,l.__)("Upload your company logo","eventin")},(0,a.createElement)(y.ng,{form:t,name:"company_logo",buttonText:(0,l.__)("Upload Logo","eventin")})))),(0,a.createElement)(s.A,{gutter:[16,0],align:"middle"},(0,a.createElement)(c.A,{xs:24},(0,a.createElement)("div",null,(0,a.createElement)(m.A,{align:"center"},(0,a.createElement)("p",{style:{margin:"10px 0px",fontSize:"16px",fontWeight:600,color:"#444444"}},(0,l.__)("Social Profiles","eventin")),(0,a.createElement)(u.A,{title:(0,l.__)("Promote your event by adding links to your social media profiles.","eventin")},(0,a.createElement)("span",{style:{marginLeft:"7px"}},(0,a.createElement)(f.InfoCircleOutlined,{width:20,height:20})))))),(0,a.createElement)(c.A,{xs:24},(0,a.createElement)(_.A,{form:t,name:"social",label:(0,l.__)("Social Profiles","eventin")}))),(0,a.createElement)(s.A,null,(0,a.createElement)(c.A,{xs:24},(0,a.createElement)(d.A.Item,{name:"hide_user",valuePropName:"checked"},(0,a.createElement)(g.A,{defaultChecked:!0,style:{fontWeight:500,margin:"20px 0px"}},(0,l.__)("Hide From Users","eventin"),(0,a.createElement)(u.A,{title:(0,l.__)("When enabled, this profile will be hidden from the “Users > All Users” list in your WordPress dashboard. This is useful for adding internal event roles without exposing them as site users.","eventin")},(0,a.createElement)("span",{style:{marginLeft:"10px"}},(0,a.createElement)(f.InfoCircleOutlined,{width:20,height:20}))))))),(0,a.createElement)(A.A,{modalOpen:r,setModalOpen:i,form:t,keyName:"speaker_group"}))})),w=[{value:"speaker",label:(0,l.__)("Speaker","eventin")},{value:"organizer",label:(0,l.__)("Organizer","eventin")}]},65407:(e,t,n)=>{n.r(t),n.d(t,{default:()=>w});var a=n(51609),r=n(29491),i=n(47143),o=n(86087),l=n(52619),s=n(27723),c=n(67313),d=n(60742),p=n(92911),m=n(428),u=n(74353),g=n.n(u),f=n(47767),v=n(7638),h=n(6836),x=n(64282),_=n(71819),E=n(86434),y=n(30549);const{Title:A,Text:k}=c.A,b=(0,i.withDispatch)((e=>{const t=e("eventin/global");return{invalidateSpeakerList:()=>t.invalidateResolution("getTotalSpeakers")}})),w=(0,r.compose)(b)((function(e){const{invalidateSpeakerList:t}=e,[n]=d.A.useForm(),{id:r}=(0,f.useParams)(),i=(0,f.useNavigate)(),c=!!r,[u,b]=(0,o.useState)(!1),[w,C]=(0,o.useState)(!1);return(0,o.useEffect)((()=>{c&&(C(!0),x.A.speakers.singleSpeaker(r).then((e=>{const t={...e,social:Array.isArray(e?.social)&&e?.social?.every((e=>Array.isArray(e)))?[{}]:e?.social,date:g()(e.date)};n.setFieldsValue(t)})).finally((()=>{C(!1)})))}),[]),(0,a.createElement)(y.ff,null,(0,a.createElement)(E.A,null),(0,a.createElement)(y.sC,{className:"eventin-create-speaker-form-wrapper"},(0,a.createElement)(y.MG,{className:"eventin-create-speaker-form-container"},(0,a.createElement)("div",{style:{marginBottom:"40px"}},(0,a.createElement)(A,{level:3,style:{fontWeight:600,margin:"0 0 8px 0",fontSize:"26px",lineHeight:"32px",color:"#111827"}},c?(0,s.__)("Update speaker & organizer for events","eventin"):(0,s.__)("New speaker & organizer for events","eventin")),(0,a.createElement)(k,{style:{fontSize:"14px",color:"#6B7280",display:"block"}},(0,s.__)("Effortlessly manage speaker and organizer profiles for a seamless event experience","eventin"))),w?(0,a.createElement)(p.A,{justify:"center",align:"center",style:{minHeight:"320px"}},(0,a.createElement)(m.A,null)):(0,a.createElement)(d.A,{layout:"vertical",form:n,scrollToFirstError:!0,size:"large",onFinish:async()=>{b(!0);try{await n.validateFields();const e=n.getFieldsValue(!0);if(e.date=(0,h.dateFormatter)(e.date),c){const n=await x.A.speakers.updateSpeaker(r,e);if(!n?.id)throw new Error((0,s.__)("Couldn't edit speaker properly!","eventin"));t(),i("/speakers"),(0,l.doAction)("eventin_notification",{type:"success",message:(0,s.__)("Successfully updated the speaker!","eventin")})}else{const n=await x.A.speakers.createSpeaker(e);if(!n?.id)throw new Error((0,s.__)("Couldn't edit speaker properly!","eventin"));t(),i("/speakers"),(0,l.doAction)("eventin_notification",{type:"success",message:(0,s.__)("Successfully created the speaker!","eventin")})}}catch(e){(0,l.doAction)("eventin_notification",{type:"error",message:(0,s.__)(`Failed to ${c?"update":"create"} the speaker!`,"eventin"),description:e?.message||""})}finally{b(!1)}}},(0,a.createElement)(_.A,{form:n}),(0,a.createElement)(p.A,{gap:12,justify:"end"},(0,a.createElement)(v.Ay,{variant:v.Vt,htmlType:"reset",onClick:()=>i("/speakers"),sx:{fontSize:"16px",fontWeight:"600",height:"44px",lineHeight:"1",color:"#262626",padding:"8px 24px"}},(0,s.__)("Cancel","eventin")),(0,a.createElement)(v.Ay,{variant:v.zB,loading:u,htmlType:"submit",sx:{fontSize:"16px",fontWeight:"600",height:"44px",lineHeight:"1"}},c?(0,s.__)("Update","eventin"):(0,s.__)("Create New","eventin")))))))}))},86434:(e,t,n)=>{n.d(t,{A:()=>g});var a=n(51609),r=n(56427),i=n(27723),o=n(92911),l=n(47767),s=n(69815),c=n(54725),d=n(7638),p=n(79664),m=n(18062),u=n(27154);function g(e){const{id:t}=(0,l.useParams)(),n=(0,l.useNavigate)(),g=!!t,f=s.default.div`
		@media ( max-width: 560px ) {
			display: none;
			border: 1px solid red;
		}
	`;return(0,a.createElement)(r.Fill,{name:u.PRIMARY_HEADER_NAME},(0,a.createElement)(o.A,{justify:"space-between",align:"center",wrap:"wrap",gap:20},(0,a.createElement)(o.A,{align:"center",gap:16},(0,a.createElement)(d.Ay,{variant:d.Vt,icon:(0,a.createElement)(c.AngleLeftIcon,null),sx:{height:"36px",width:"36px",backgroundColor:"#fafafa",borderColor:"transparent",lineHeight:"1"},onClick:()=>{n("/speakers")}}),(0,a.createElement)(m.A,{title:g?(0,i.__)("Update Speaker / Organizer","eventin"):(0,i.__)("Add Speaker / Organizer","eventin")})),(0,a.createElement)(f,null,(0,a.createElement)(p.A,null))))}},30549:(e,t,n)=>{n.d(t,{MG:()=>o,ff:()=>r,sC:()=>i});var a=n(69815);const r=a.default.div`
	background: #f3f5f7;
	min-height: calc( 100vh - 60px );
	padding-top: 30px;
`,i=a.default.div`
	background: #ffffff;
	border: 1px solid #e1e4e9;
	border-radius: 8px;
	padding: 20px;
	margin: 30px;
	margin-top: 0;
	@media ( max-width: 768px ) {
		padding: 10px;
		margin: 5px;
	}
`,o=a.default.div`
	max-width: 800px;
	padding: 20px 40px;
	margin: 0 auto;
	@media ( max-width: 768px ) {
		padding: 10px;
	}
`;a.default.div`
	padding-right: 20px;
	@media ( max-width: 768px ) {
		padding-right: 10px;
	}
`},96031:(e,t,n)=>{n.d(t,{A:()=>h});var a=n(51609),r=n(56427),i=n(27723),o=n(92911),l=n(52741),s=n(11721),c=n(47767),d=n(69815),p=n(7638),m=n(79664),u=n(18062),g=n(27154),f=n(54725);const v=d.default.div`
	@media ( max-width: 360px ) {
		display: none;
		border: 1px solid red;
	}
`;function h(e){const{title:t,buttonText:n,onClickCallback:d}=e,h=(0,c.useNavigate)(),{pathname:x}=(0,c.useLocation)(),_=["/speakers"!==x&&{key:"0",label:(0,i.__)("Speaker List","eventin"),icon:(0,a.createElement)(f.EventListIcon,{width:20,height:20}),onClick:()=>{h("/speakers")}},"/speakers/group"!==x&&{key:"2",label:(0,i.__)("Speaker Groups","eventin"),icon:(0,a.createElement)(f.CategoriesIcon,null),onClick:()=>{h("/speakers/group")}}];return(0,a.createElement)(r.Fill,{name:g.PRIMARY_HEADER_NAME},(0,a.createElement)(o.A,{justify:"space-between",align:"center",wrap:"wrap",gap:20},(0,a.createElement)(u.A,{title:t}),(0,a.createElement)("div",{style:{display:"flex",alignItems:"center"}},(0,a.createElement)(p.Ay,{variant:p.zB,htmlType:"button",onClick:d,sx:{display:"flex",alignItems:"center",fontSize:"16px",fontWeight:600,borderRadius:"6px",height:"44px"}},(0,a.createElement)(f.PlusOutlined,null),n),(0,a.createElement)(l.A,{type:"vertical",style:{height:"44px",marginInline:"12px",top:"0"}}),(0,a.createElement)(o.A,{gap:12},(0,a.createElement)(s.A,{menu:{items:_},trigger:["click"],placement:"bottomRight",overlayClassName:"action-dropdown"},(0,a.createElement)(p.Ay,{variant:p.Vt,sx:{borderColor:"#E5E5E5",color:"#8C8C8C",height:"44px",lineHeight:"1"}},(0,a.createElement)(f.MoreIconOutlined,null))),(0,a.createElement)(v,null,(0,a.createElement)(m.A,null))))))}},1806:(e,t,n)=>{n.d(t,{A:()=>g});var a=n(51609),r=n(19549),i=n(29491),o=n(47143),l=n(52619),s=n(27723),c=n(54725),d=n(7638),p=n(64282);const{confirm:m}=r.A,u=(0,o.withDispatch)((e=>{const t=e("eventin/global");return{refreshGroupList:()=>t.invalidateResolution("getSpeakerCategories")}})),g=(0,i.compose)(u)((function(e){const{refreshGroupList:t,record:n}=e;return(0,a.createElement)(d.Ay,{variant:d.Vt,onClick:()=>{m({title:(0,s.__)("Are you sure?","eventin"),icon:(0,a.createElement)(c.DeleteOutlinedEmpty,null),content:(0,s.__)("Are you sure you want to delete this group?","eventin"),okText:(0,s.__)("Delete","eventin"),okButtonProps:{type:"primary",danger:!0,classNames:"delete-btn"},centered:!0,onOk:async()=>{try{await p.A.speakerCategories.deleteCategory(n.id),t(),(0,l.doAction)("eventin_notification",{type:"success",message:(0,s.__)("Successfully deleted the group!","eventin")})}catch(e){console.error("Error deleting group!",e),(0,l.doAction)("eventin_notification",{type:"error",message:(0,s.__)("Failed to delete the group!","eventin")})}},onCancel(){console.log("Cancel")}})}},(0,a.createElement)(c.DeleteOutlined,{width:"16",height:"16"}))}))},43647:(e,t,n)=>{n.d(t,{A:()=>s});var a=n(51609),r=n(86087),i=n(54725),o=n(7638),l=n(65981);function s(e){const{record:t}=e,{setGroupsData:n}=(0,r.useContext)(l.SpeakersGroupContext);return(0,a.createElement)(o.Ay,{variant:o.Vt,onClick:()=>{n((e=>({...e,editData:t,isModalOpen:!0})))}},(0,a.createElement)(i.EditOutlined,{width:"16",height:"16"}))}},54711:(e,t,n)=>{n.d(t,{A:()=>l});var a=n(51609),r=n(90070),i=n(1806),o=n(43647);function l(e){const{record:t}=e;return(0,a.createElement)(r.A,{size:"small",className:"event-actions"},(0,a.createElement)(o.A,{record:t}),(0,a.createElement)(i.A,{record:t}))}},51837:(e,t,n)=>{n.d(t,{A:()=>l});var a=n(51609),r=n(27723),i=n(54711),o=n(84601);window.innerWidth;const l=[{title:(0,r.__)("ID","eventin"),dataIndex:"id",key:"id",defaultSortOrder:"ascend",sorter:(e,t)=>e.id-t.id},{title:(0,r.__)("Group","eventin"),dataIndex:"name",key:"name",width:"30%",render:(e,t)=>(0,a.createElement)(o.A,{text:e,record:t})},{title:(0,r.__)("Count","eventin"),dataIndex:"count",key:"count",render:e=>(0,a.createElement)("span",{className:"author"},e)},{title:(0,r.__)("Action","eventin"),key:"action",width:120,render:(e,t)=>(0,a.createElement)(i.A,{record:t})}]},59320:(e,t,n)=>{n.d(t,{A:()=>g});var a=n(51609),r=n(92911),i=n(79888),o=n(86087),l=n(27723),s=n(54725),c=n(79351),d=n(62215),p=n(61149),m=n(64282),u=n(65981);const g=e=>{const{selectedGroups:t,setSelectedGroups:n}=e,{setGroupsData:g}=(0,o.useContext)(u.SpeakersGroupContext),f=!!t?.length;return(0,a.createElement)(p.O,{className:"filter-wrapper"},(0,a.createElement)(r.A,{justify:f?"space-between":"flex-end",align:"center"},(0,a.createElement)(r.A,{justify:"start",align:"center",gap:8},f&&(0,a.createElement)(c.A,{refreshListName:"getSpeakerCategories",selectedCount:t?.length,callbackFunction:async()=>{const e=(0,d.A)(t);await m.A.speakerCategories.deleteCategory(e),n([])},setSelectedRows:n})),!f&&(0,a.createElement)(i.A,{className:"event-filter-by-name",placeholder:(0,l.__)("Search by group name","eventin"),size:"default",prefix:(0,a.createElement)(s.SearchIconOutlined,null),onChange:e=>{g((t=>({...t,filter:{...t.filter,searchTerm:e.target.value}})))},allowClear:!0})))}},82615:(e,t,n)=>{n.d(t,{A:()=>u});var a=n(51609),r=n(86087),i=n(27723),o=n(75063),l=n(16784),s=n(65981),c=n(59320),d=n(51837),p=n(61328),m=n(75093);function u(e){const{groupList:t,isLoading:n}=e,[u,g]=(0,r.useState)([]),[f,v]=(0,r.useState)([]),{groupsData:h}=(0,r.useContext)(s.SpeakersGroupContext),x={selectedRowKeys:f,onChange:e=>{v(e)}};return(0,r.useEffect)((()=>{(()=>{let e=t;h?.filter?.searchTerm&&(e=e?.filter((e=>e?.name?.toLowerCase()?.includes(h?.filter?.searchTerm?.toLowerCase())))),g(e)})()}),[t,h]),n?(0,a.createElement)(p.f,{className:"eventin-page-wrapper"},(0,a.createElement)(o.A,{active:!0})):(0,a.createElement)(p.f,{className:"eventin-page-wrapper"},(0,a.createElement)("div",{className:"event-list-wrapper"},(0,a.createElement)(c.A,{selectedGroups:f,setSelectedGroups:v,groupList:t}),(0,a.createElement)(l.A,{className:"eventin-data-table",columns:d.A,dataSource:u,rowSelection:x,rowKey:e=>e.id,scroll:{x:560},sticky:{offsetHeader:80},showSorterTooltip:!1,pagination:{showTotal:(e,t)=>(0,a.createElement)(m.CustomShowTotal,{totalCount:e,range:t,listText:(0,i.__)("groups","eventin")})}})))}},84601:(e,t,n)=>{n.d(t,{A:()=>o});var a=n(51609),r=n(86087),i=n(65981);function o(e){const{text:t,record:n}=e,{setGroupsData:o}=(0,r.useContext)(i.SpeakersGroupContext);return(0,a.createElement)("p",{style:{cursor:"pointer",color:"#020617",fontSize:"18px",margin:0,fontWeight:600},onClick:()=>{o((e=>({...e,editData:n,isModalOpen:!0})))}},t)}},61328:(e,t,n)=>{n.d(t,{f:()=>r});var a=n(69815);const r=a.default.div`
	background-color: #f4f6fa;
	padding: 12px 32px;
	min-height: 100vh;

	.ant-table-wrapper {
		padding: 15px 30px;
		background-color: #fff;
		border-radius: 0 0 12px 12px;
	}

	.ant-table-thead {
		> tr {
			> th {
				background-color: #ffffff;
				padding-top: 10px;
				font-weight: 500;
				color: #7a7a99;
				&:before {
					display: none;
				}
			}
			th.ant-table-column-sort {
				background-color: transparent;
			}
		}
	}
	.ant-table-wrapper td.ant-table-column-sort {
		background-color: transparent;
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

	.title {
		color: #020617;
		font-size: 18px;
		font-weight: 600;
		line-height: 26px;
		display: inline-flex;
		margin-bottom: 6px;
	}
`;a.default.div`
	padding: 22px 36px;
	background: #fff;
	border-radius: 12px 12px 0 0;
	border-bottom: 1px solid #ddd;

	.event-filter-by-name {
		height: 36px;
		border: 1px solid #ddd;
		max-width: 220px;

		input.ant-input {
			min-height: auto;
		}
	}
`},65981:(e,t,n)=>{n.r(t),n.d(t,{SpeakersGroupContext:()=>m,default:()=>g});var a=n(51609),r=n(29491),i=n(47143),o=n(86087),l=n(27723),s=n(57770),c=n(96031),d=n(82615),p=n(23985);const m=(0,o.createContext)(),u=(0,i.withSelect)((e=>{const t=e("eventin/global");return{groupList:t.getSpeakerCategories(),isLoading:t.isResolving("getSpeakerCategories")}})),g=(0,r.compose)(u)((function(e){const{groupList:t,isLoading:n}=e;let r=(0,s.A)(t,"name");const[i,u]=(0,o.useState)({filter:{group:null,searchTerm:null},editData:{},isModalOpen:!1}),g=e=>{u((t=>({...t,isModalOpen:e})))};return(0,a.createElement)(m.Provider,{value:{groupsData:i,setGroupsData:u}},(0,a.createElement)("div",{className:"event-tags-wrapper"},(0,a.createElement)(c.A,{title:(0,l.__)("Speakers Group","eventin"),onClickCallback:()=>g(!0),buttonText:(0,l.__)("New Group","eventin")}),(0,a.createElement)(d.A,{isLoading:n,groupList:r}),(0,a.createElement)(p.A,{modalOpen:i.isModalOpen,setModalOpen:g})))}))},23985:(e,t,n)=>{n.d(t,{A:()=>f});var a=n(51609),r=n(29491),i=n(47143),o=n(86087),l=n(52619),s=n(27723),c=n(60742),d=n(500),p=n(10012),m=n(64282),u=n(65981);const g=(0,i.withDispatch)((e=>{const t=e("eventin/global");return{refreshCategoryList:()=>t.invalidateResolution("getSpeakerCategories")}})),f=(0,r.compose)(g)((e=>{const{modalOpen:t,setModalOpen:n,refreshCategoryList:r,keyName:i,...g}=e,[f]=c.A.useForm(),[v,h]=(0,o.useState)(!1),{groupsData:x,setGroupsData:_}=(0,o.useContext)(u.SpeakersGroupContext)||{},E=x?.editData?.id;return(0,o.useEffect)((()=>{if(t){if(E){const{name:e}=x?.editData;f.setFieldsValue({name:e})}}else f.resetFields(),_&&_((e=>({...e,editData:{}})))}),[t]),(0,a.createElement)(d.A,{title:(0,s.__)(E?"Edit Group":"New Group","eventin"),open:t,onCancel:()=>n(!1),cancelText:(0,s.__)("Cancel","eventin"),okText:(0,s.__)(E?" Update Group":"Add Group","eventin"),onOk:async()=>{await f.validateFields();try{h(!0);const t=f.getFieldsValue(!0);if(E){const e=x?.editData?.id;await m.A.speakerCategories.updateCategory(e,t),(0,l.doAction)("eventin_notification",{type:"success",message:(0,s.__)("Successfully updated the group!","eventin")})}else{const n=await m.A.speakerCategories.createCategory(t);if(e?.form&&n?.id){const t=e?.form?.getFieldValue(i,{preserve:!0})||[];Array.isArray(t)&&e?.form?.setFieldsValue({[i]:[n?.id,...t]})}(0,l.doAction)("eventin_notification",{type:"success",message:(0,s.__)("Successfully created group!","eventin")})}r(),n(!1),f.resetFields()}catch(e){(0,l.doAction)("eventin_notification",{type:"error",message:(0,s.__)(`Couldn't ${E?"Update":"Create"} Speaker Group`,"eventin"),description:`Reason: ${e?.message}`}),console.error(e)}finally{h(!1)}},confirmLoading:v,destroyOnClose:!0},(0,a.createElement)(c.A,{layout:"vertical",form:f},(0,a.createElement)("div",null,(0,a.createElement)(p.ks,{name:"name",placeholder:"Enter Group Name",label:(0,s.__)("Group Name","eventin"),size:"middle",rules:[{required:!0,message:(0,s.__)("Group Name is Required!","eventin")}],required:!0}))))}))}}]);