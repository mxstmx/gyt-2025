"use strict";(globalThis.webpackChunkwp_event_solution=globalThis.webpackChunkwp_event_solution||[]).push([[483],{63757:(e,t,a)=>{a.d(t,{A:()=>u});var n=a(51609),r=a(1455),o=a.n(r),i=a(86087),l=a(52619),s=a(27723),c=a(7638),p=a(32099),d=a(11721),m=a(54725),g=a(48842);const u=e=>{const{type:t,arrayOfIds:a,shouldShow:r,eventId:u}=e||{},[h,v]=(0,i.useState)(!1),f=async(e,t,a)=>{const n=new Blob([e],{type:a}),r=URL.createObjectURL(n),o=document.createElement("a");o.href=r,o.download=t,o.click(),URL.revokeObjectURL(r)},x=async e=>{let n=`/eventin/v2/${t}/export`;u&&(n+=`?event_id=${u}`);try{if(v(!0),"json"===e){const r=await o()({path:n,method:"POST",data:{format:e,ids:a||[]}});await f(JSON.stringify(r,null,2),`${t}.json`,"application/json")}if("csv"===e){const r=await o()({path:n,method:"POST",data:{format:e,ids:a||[]},parse:!1}),i=await r.text();await f(i,`${t}.csv`,"text/csv")}(0,l.doAction)("eventin_notification",{type:"success",message:(0,s.__)("Exported successfully","eventin")})}catch(e){console.error("Error exporting data",e),(0,l.doAction)("eventin_notification",{type:"error",message:e.message})}finally{v(!1)}},y=[{key:"1",label:(0,n.createElement)(g.A,{style:{padding:"10px 0"},onClick:()=>x("json")},(0,s.__)("Export JSON Format","eventin")),icon:(0,n.createElement)(m.JsonFileIcon,null)},{key:"2",label:(0,n.createElement)(g.A,{onClick:()=>x("csv")},(0,s.__)("Export CSV Format","eventin")),icon:(0,n.createElement)(m.CsvFileIcon,null)}],k={display:"flex",alignItems:"center",borderColor:"#d9d9d9",fontSize:"14px",fontWeight:400,color:"#64748B",height:"36px"};return(0,n.createElement)(p.A,{title:r?(0,s.__)("Upgrade to Pro","eventin"):(0,s.__)("Download table data","eventin")},r?(0,n.createElement)(c.Ay,{className:"etn-export-btn eventin-export-button",variant:c.Vt,onClick:()=>window.open("https://themewinter.com/eventin/pricing/","_blank"),sx:k},(0,n.createElement)(m.ExportIcon,{width:20,height:20}),(0,s.__)("Export","eventin"),r&&(0,n.createElement)(m.ProFlagIcon,null)):(0,n.createElement)(d.A,{overlayClassName:"etn-export-actions action-dropdown",menu:{items:y},placement:"bottomRight",arrow:!0,disabled:r},(0,n.createElement)(c.Ay,{className:"etn-export-btn eventin-export-button",variant:c.Vt,loading:h,sx:k},(0,n.createElement)(m.ExportIcon,{width:20,height:20}),(0,s.__)("Export","eventin"))))}},84174:(e,t,a)=>{a.d(t,{A:()=>h});var n=a(51609),r=a(1455),o=a.n(r),i=a(86087),l=a(27723),s=a(52619),c=a(81029),p=a(32099),d=a(19549),m=a(7638),g=a(54725);const{Dragger:u}=c.A,h=e=>{const{type:t,paramsKey:a,shouldShow:r,revalidateList:c}=e||{},[h,v]=(0,i.useState)([]),[f,x]=(0,i.useState)(!1),[y,k]=(0,i.useState)(!1),E=()=>{k(!1)},b=`/eventin/v2/${t}/import`,w=(0,i.useCallback)((async e=>{try{x(!0);const t=await o()({path:b,method:"POST",body:e});return(0,s.doAction)("eventin_notification",{type:"success",message:(0,l.__)(` ${t?.message} `,"eventin")}),c(!0),v([]),x(!1),E(),t?.data||""}catch(e){throw x(!1),(0,s.doAction)("eventin_notification",{type:"error",message:e.message}),console.error("API Error:",e),e}}),[t]),_={name:"file",accept:".json, .csv",multiple:!1,maxCount:1,onRemove:e=>{const t=h.indexOf(e),a=h.slice();a.splice(t,1),v(a)},beforeUpload:e=>(v([e]),!1),fileList:h},A=r?()=>window.open("https://themewinter.com/eventin/pricing/","_blank"):()=>k(!0);return(0,n.createElement)(n.Fragment,null,(0,n.createElement)(p.A,{title:r?(0,l.__)("Upgrade to Pro","eventin"):(0,l.__)("Import data","eventin")},(0,n.createElement)(m.Ay,{className:"etn-import-btn eventin-import-button",variant:m.Vt,sx:{display:"flex",alignItems:"center",borderColor:"#d9d9d9",fontSize:"14px",fontWeight:400,color:"#64748B",height:"36px"},onClick:A},(0,n.createElement)(g.ImportIcon,null),(0,l.__)("Import","eventin"),r&&(0,n.createElement)(g.ProFlagIcon,null))),(0,n.createElement)(d.A,{title:(0,l.__)("Import file","eventin"),open:y,onCancel:E,maskClosable:!1,footer:null,centered:!0,destroyOnClose:!0,wrapClassName:"etn-import-modal-wrap",className:"etn-import-modal-container eventin-import-modal-container"},(0,n.createElement)("div",{className:"etn-import-file eventin-import-file-container",style:{marginTop:"25px"}},(0,n.createElement)(u,{..._},(0,n.createElement)("p",{className:"ant-upload-drag-icon"},(0,n.createElement)(g.UploadCloudIcon,{width:"50",height:"50"})),(0,n.createElement)("p",{className:"ant-upload-text"},(0,l.__)("Click or drag file to this area to upload","eventin")),(0,n.createElement)("p",{className:"ant-upload-hint"},(0,l.__)("Choose a JSON or CSV file to import","eventin")),0!=h.length&&(0,n.createElement)(m.Ay,{onClick:async e=>{e.preventDefault(),e.stopPropagation();const t=new FormData;t.append(a,h[0],h[0].name),await w(t)},disabled:0===h.length,loading:f,variant:m.zB,className:"eventin-start-import-button"},f?(0,l.__)("Importing","eventin"):(0,l.__)("Start Import","eventin"))))))}},61149:(e,t,a)=>{a.d(t,{O:()=>o,f:()=>r});var n=a(69815);const r=n.default.div`
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
`,o=n.default.div`
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
`},1483:(e,t,a)=>{a.r(t),a.d(t,{default:()=>te});var n=a(51609),r=a(27723),o=a(47767),i=a(96031),l=a(29491),s=a(47143),c=a(86087),p=a(75063),d=a(16784),m=a(75093),g=a(18537),u=a(90070),h=a(19549),v=a(52619),f=a(54725),x=a(7638),y=a(64282);const{confirm:k}=h.A,E=(0,s.withDispatch)((e=>({shouldRefetchSpeakerList:e("eventin/global").setRevalidateSpeakerList}))),b=(0,l.compose)(E)((function(e){const{shouldRefetchSpeakerList:t,record:a}=e;return(0,n.createElement)(x.Ib,{variant:x.Vt,onClick:()=>{k({title:(0,r.__)("Are you sure?","eventin"),icon:(0,n.createElement)(f.DeleteOutlinedEmpty,null),content:(0,r.__)("Are you sure you want to delete this speaker?","eventin"),okText:(0,r.__)("Delete","eventin"),okButtonProps:{type:"primary",danger:!0,classNames:"delete-btn"},centered:!0,onOk:async()=>{try{await y.A.speakers.deleteSpeaker(a.id),t(!0),(0,v.doAction)("eventin_notification",{type:"success",message:(0,r.__)("Successfully deleted the speaker!","eventin")})}catch(e){console.error("Error deleting category",e),(0,v.doAction)("eventin_notification",{type:"error",message:(0,r.__)("Failed to delete the speaker!","eventin")})}},onCancel(){}})}})}));function w(e){const{record:t}=e,a=(0,o.useNavigate)();return(0,n.createElement)(x.vQ,{variant:x.Vt,onClick:()=>{a(`/speakers/edit/${t.id}`)}})}var _=a(36877),A=a(46784),S=a(500),C=a(57237),N=a(48842),I=a(27154),L=a(69815);const R=L.default.div`
	padding: 20px;
	@media ( min-width: 767px ) {
		padding: 40px;
	}
	.etn-speaker-view-wrapper {
		display: flex;
		flex-direction: column;
		gap: 20px;
		@media ( min-width: 767px ) {
			flex-direction: row;
		}
	}

	.etn-speaker-header {
		display: flex;
		align-items: center;
		gap: 10px;
		margin-bottom: 10px;
		flex-wrap: wrap;
	}
	.etn-speaker-content {
		display: flex;
		flex-direction: column;
		gap: 10px;
	}
	.etn-speaker-social {
		display: flex;
		gap: 10px;
		align-items: center;
		margin-top: 10px;
	}
`,O=L.default.div`
	width: 30px;
	height: 30px;
	display: flex;
	justify-content: center;
	align-items: center;
	border: 1px solid #ccc;
	border-radius: 5px;
	cursor: pointer;
`,z=e=>{const{modalOpen:t,setModalOpen:a,recordData:r}=e,{id:i,name:l,category:s,designation:c,summary:p,email:d,social:m,image:g}=r,u=(0,o.useNavigate)(),h=e=>{const t=I.socialIcons.find((t=>t.iconClass===e));return t?.icon||null};return(0,n.createElement)(S.A,{open:t,onCancel:()=>a(!1),header:!1,footer:!1,width:680,destroyOnClose:!0},(0,n.createElement)(R,null,(0,n.createElement)("div",{className:"etn-speaker-view-wrapper"},g?(0,n.createElement)("img",{style:{width:150,height:150,objectFit:"cover",border:"1px solid #f0f0f0",borderRadius:"8px"},src:g,alt:"speaker-image"}):(0,n.createElement)(_.A,{shape:"square",size:150}),(0,n.createElement)("div",{className:"etn-speaker-details"},(0,n.createElement)("div",{className:"etn-speaker-header"},(0,n.createElement)(C.A,{level:3,style:{fontSize:20,margin:0}},l),s&&s.map(((e,t)=>(0,n.createElement)(N.A,{style:{fontSize:12,color:"#1890FF",backgroundColor:"#1890FF1A",padding:"5px 8px",borderRadius:"20px"},key:t},e))),(0,n.createElement)(x.Ay,{variant:x.qy,onClick:()=>u(`/speakers/edit/${i}`),style:{color:"#1890FF",fontWeight:"bold",padding:"4px 10px"}},(0,n.createElement)(f.EditOutlined,{width:"16",height:"16"}))),(0,n.createElement)("div",{className:"etn-speaker-content"},c&&(0,n.createElement)(N.A,null,c),d&&(0,n.createElement)(N.A,null,d),(0,n.createElement)("div",{className:"etn-speaker-social"},m&&m?.map(((e,t)=>(0,n.createElement)(O,{key:t,onClick:()=>window.open(e?.etn_social_url,"_blank")},(0,n.createElement)(A.g,{icon:h(e?.icon),size:"1x"})))))))),(0,n.createElement)("div",{className:"etn-speaker-bio",style:{marginTop:"20px"}},(0,n.createElement)(N.A,null,p))))};function F(e){const[t,a]=(0,c.useState)(!1),{record:r}=e;return(0,n.createElement)(n.Fragment,null,(0,n.createElement)(x.Ay,{variant:x.Vt,onClick:()=>{window.open(`${r?.author_url}`,"_blank")}},(0,n.createElement)(f.EyeOutlinedIcon,{width:"16",height:"16"})),(0,n.createElement)(z,{modalOpen:t,setModalOpen:a,recordData:r}))}function j(e){const{record:t}=e;return(0,n.createElement)(u.A,{size:"small",className:"event-actions"},(0,n.createElement)(F,{record:t}),(0,n.createElement)(w,{record:t}),(0,n.createElement)(b,{record:t}))}var T=a(84976);const P=[{title:(0,r.__)("Name","eventin"),dataIndex:"name",key:"name",width:"20%",render:(e,t)=>(0,n.createElement)(T.Link,{to:`/speakers/edit/${t.id}`,className:"event-title"},(0,g.decodeEntities)(e))},{title:(0,r.__)("Job Title","eventin"),dataIndex:"designation",key:"designation",render:e=>(0,n.createElement)("span",{className:"author"}," ",(0,g.decodeEntities)(e)||"-")},{title:(0,r.__)("Group","eventin"),dataIndex:"speaker_group",key:"speaker_group",render:e=>(0,n.createElement)("span",null,Array.isArray(e)&&e?.join(", "))},{title:(0,r.__)("Role","eventin"),dataIndex:"category",key:"category",render:e=>e?.map((e=>(0,n.createElement)("span",{className:"etn-category-group"},e)))},{title:(0,r.__)("Company","eventin"),dataIndex:"company_name",key:"company_name",render:e=>(0,n.createElement)("span",{className:"author"}," ",(0,g.decodeEntities)(e)||"-")},{title:(0,r.__)("Action","eventin"),key:"action",width:120,render:(e,t)=>(0,n.createElement)(j,{record:t})}];var D=a(92911),V=a(36492),$=a(79888),B=a(79351),U=a(62215),M=a(61149),W=a(63757),G=a(84174),J=a(57933);const K=(0,s.withSelect)((e=>{const t=e("eventin/global");return{speakerGroup:t.getSpeakerCategories(),isLoading:t.isResolving("getSpeakerCategories")}})),H=(0,s.withDispatch)((e=>({shouldRefetchSpeakerList:e("eventin/global").setRevalidateSpeakerList}))),q=(0,l.compose)(K,H)((e=>{const{selectedSpeakers:t,setSelectedSpeakers:a,setParams:o,speakerGroup:i,shouldRefetchSpeakerList:l}=e,s=!!t?.length,c=i?.map((e=>({label:e.name,value:e.id}))),p=[{label:(0,r.__)("All","eventin"),value:"all"},{label:(0,r.__)("Speaker","eventin"),value:"speaker"},{label:(0,r.__)("Organizer","eventin"),value:"organizer"}],d=(0,J.useDebounce)((e=>{o((t=>({...t,search:e.target.value||void 0})))}),500);return(0,n.createElement)(M.O,{className:"filter-wrapper"},(0,n.createElement)(D.A,{justify:"space-between",align:"center",wrap:"wrap",gap:10},(0,n.createElement)(D.A,{justify:"start",align:"center",gap:8,wrap:"wrap"},s?(0,n.createElement)(B.A,{selectedCount:t?.length,callbackFunction:async()=>{const e=(0,U.A)(t);await y.A.speakers.deleteSpeaker(e),l(!0),a([])},setSelectedRows:a}):(0,n.createElement)(n.Fragment,null,(0,n.createElement)(V.A,{placeholder:(0,r.__)("Filter by Group","eventin"),options:c,size:"default",style:{minWidth:"200px",width:"100%"},onChange:e=>{o((t=>({...t,speaker_group:e})))},allowClear:!0,showSearch:!0,filterOption:(e,t)=>t?.label?.toLowerCase().includes(e?.toLowerCase())}),(0,n.createElement)(V.A,{placeholder:(0,r.__)("Filter by Role","eventin"),options:p,defaultValue:"all",size:"default",style:{minWidth:"200px",width:"100%"},onChange:e=>{o((t=>({...t,category:e})))},allowClear:!0,showSearch:!0}))),!s&&(0,n.createElement)(D.A,{justify:"end",gap:8},(0,n.createElement)($.A,{className:"event-filter-by-name",placeholder:(0,r.__)("Search by Name","eventin"),size:"default",prefix:(0,n.createElement)(f.SearchIconOutlined,null),onChange:d,allowClear:!0}),(0,n.createElement)(W.A,{type:"speakers"}),(0,n.createElement)(G.A,{type:"speakers",paramsKey:"speaker_import",revalidateList:l})),s&&(0,n.createElement)(D.A,{justify:"end",gap:8},(0,n.createElement)(W.A,{type:"speakers",arrayOfIds:t}))))}));var Q=a(6836);const X=L.default.div`
	background-color: #f4f6fa;
	padding: 12px 32px;
	min-height: 100vh;

	.ant-table-wrapper {
		padding: 15px 30px;
		background-color: #fff;
		border-radius: 0 0 12px 12px;
	}

	.event-list-wrapper {
		border-radius: 0 0 12px 12px;
	}

	.ant-table-thead {
		> tr {
			> th {
				background-color: #ffffff;
				padding-top: 10px;
				font-weight: 600;
				color: #7a7a99;
				font-size: 16px;
				&:before {
					display: none;
				}
			}
		}
	}

	tr {
		&:hover {
			background-color: #f8fafc !important;
		}
	}

	.event-title {
		color: #262626;
		font-size: 16px;
		font-weight: 600;
		line-height: 26px;
		display: inline-flex;
		margin-bottom: 6px;
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
			border-color: #94a3b8;
			color: #525266;
			background-color: #f5f5f5;
		}
	}

	.etn-category-group {
		display: flex;
		gap: 10px;
		text-transform: capitalize;
	}
`,Y=(L.default.div`
	padding: 22px 36px;
	background: #fff;
	border-radius: 12px 12px 0 0;
	border-bottom: 1px solid #ddd;

	.ant-form-item {
		margin-bottom: 0;
	}

	.event-filter-by-name {
		height: 36px;
		border: 1px solid #ddd;
		max-width: 220px;

		input.ant-input {
			min-height: auto;
		}
	}
`,(0,s.withDispatch)((e=>({setShouldRevalidateSpeakerList:e("eventin/global").setRevalidateSpeakerList})))),Z=(0,s.withSelect)((e=>({shouldRevalidateSpeakerList:e("eventin/global").getRevalidateSpeakerList()}))),ee=(0,l.compose)([Y,Z])((({isLoading:e,setShouldRevalidateSpeakerList:t,shouldRevalidateSpeakerList:a})=>{const[i,l]=(0,c.useState)({paged:1,per_page:10}),[s,g]=(0,c.useState)([]),{filteredList:u,totalCount:h,loading:v}=((e,t,a)=>{const[n,r]=(0,c.useState)([]),[i,l]=(0,c.useState)(null),[s,p]=(0,c.useState)(!0),d=(0,o.useNavigate)(),m=(0,c.useCallback)((async()=>{p(!0);try{const{paged:t,per_page:a,speaker_group:n,category:o,search:i}=e,s=await y.A.speakers.speakersList({speaker_group:n,category:o,search:i,paged:t,per_page:a}),c=Boolean(n)||Boolean(o)||Boolean(i),p=s.headers.get("X-Wp-Total")||0;l(p);const m=await s.json();r(m||[]),c||0!==Number(p)||d("/speakers/empty",{replace:!0})}catch(e){console.error("Error fetching speakers:",e)}finally{p(!1),(0,Q.scrollToTop)()}}),[e,d]);return(0,c.useEffect)((()=>{m()}),[m]),(0,c.useEffect)((()=>{t&&(m(),a(!1))}),[t,m,a]),{filteredList:n,totalCount:i,loading:s}})(i,a,t),f=(0,c.useMemo)((()=>({selectedRowKeys:s,onChange:g})),[s]),x=(0,c.useMemo)((()=>({current:i.paged,pageSize:i.per_page,total:h,showSizeChanger:!0,showLessItems:!0,onShowSizeChange:(e,t)=>l((e=>({...e,per_page:t}))),onChange:e=>l((t=>({...t,paged:e}))),showTotal:(e,t)=>(0,n.createElement)(m.CustomShowTotal,{totalCount:e,range:t,listText:(0,r.__)(" speakers","eventin")})})),[i,h]);return e?(0,n.createElement)(X,{className:"eventin-page-wrapper"},(0,n.createElement)(p.A,{active:!0})):(0,n.createElement)(X,{className:"eventin-page-wrapper"},(0,n.createElement)("div",{className:"event-list-wrapper"},(0,n.createElement)(q,{selectedSpeakers:s,setSelectedSpeakers:g,setParams:l}),(0,n.createElement)(d.A,{className:"eventin-data-table",columns:P,dataSource:u,loading:v,rowSelection:f,rowKey:e=>e.id,scroll:{x:900},sticky:{offsetHeader:100},pagination:x})))})),te=function(){const e=(0,o.useNavigate)();return(0,n.createElement)("div",null,(0,n.createElement)(i.A,{title:(0,r.__)("Speakers and Organizers","eventin"),buttonText:(0,r.__)("Add New","eventin"),onClickCallback:()=>e("/speakers/create")}),(0,n.createElement)(ee,null))}},96031:(e,t,a)=>{a.d(t,{A:()=>f});var n=a(51609),r=a(56427),o=a(27723),i=a(92911),l=a(52741),s=a(11721),c=a(47767),p=a(69815),d=a(7638),m=a(79664),g=a(18062),u=a(27154),h=a(54725);const v=p.default.div`
	@media ( max-width: 360px ) {
		display: none;
		border: 1px solid red;
	}
`;function f(e){const{title:t,buttonText:a,onClickCallback:p}=e,f=(0,c.useNavigate)(),{pathname:x}=(0,c.useLocation)(),y=["/speakers"!==x&&{key:"0",label:(0,o.__)("Speaker List","eventin"),icon:(0,n.createElement)(h.EventListIcon,{width:20,height:20}),onClick:()=>{f("/speakers")}},"/speakers/group"!==x&&{key:"2",label:(0,o.__)("Speaker Groups","eventin"),icon:(0,n.createElement)(h.CategoriesIcon,null),onClick:()=>{f("/speakers/group")}}];return(0,n.createElement)(r.Fill,{name:u.PRIMARY_HEADER_NAME},(0,n.createElement)(i.A,{justify:"space-between",align:"center",wrap:"wrap",gap:20},(0,n.createElement)(g.A,{title:t}),(0,n.createElement)("div",{style:{display:"flex",alignItems:"center"}},(0,n.createElement)(d.Ay,{variant:d.zB,htmlType:"button",onClick:p,sx:{display:"flex",alignItems:"center",fontSize:"16px",fontWeight:600,borderRadius:"6px",height:"44px"}},(0,n.createElement)(h.PlusOutlined,null),a),(0,n.createElement)(l.A,{type:"vertical",style:{height:"44px",marginInline:"12px",top:"0"}}),(0,n.createElement)(i.A,{gap:12},(0,n.createElement)(s.A,{menu:{items:y},trigger:["click"],placement:"bottomRight",overlayClassName:"action-dropdown"},(0,n.createElement)(d.Ay,{variant:d.Vt,sx:{borderColor:"#E5E5E5",color:"#8C8C8C",height:"44px",lineHeight:"1"}},(0,n.createElement)(h.MoreIconOutlined,null))),(0,n.createElement)(v,null,(0,n.createElement)(m.A,null))))))}}}]);