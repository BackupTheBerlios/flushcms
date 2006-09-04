var OUTLOOKBAR_DEFINITION = {
	format:{
		target:'main',
		blankImage:'images/b.gif',
		rollback:true,
		animationSteps:2,
		animationDelay:20,
		templates:{
			panel:{
				normal:'<div style="width: 100%;"><div style="border-style: solid; border-color: #D0D0D0; border-width: 1px 4px;"><div style="border: 1px outset white; font: bold 8pt verdana; text-align: center; background-color: #A09060; color: white; padding: 4px;">{text}</div></div></div>'
			},
			item:{
				normal:'<table border="0" bgcolor="#D0D0D0" cellspacing="3" width="100%"><tr><td width="30" align="center"><img src="images/{image}.gif" width="15" height="15" style="display: block;" /></td><td style="font: 8pt tahoma;">{text}</td></tr></table>'
			},
			upArrow:{
				normal:'<img src="images/arr_up.gif" width="30" height="30" />'
			},
			downArrow:{
				normal:'<img src="images/arr_down.gif" width="30" height="30" />'
			}
		}
	},
	panels:[
		{text:"Positive", url:'dummy.html?id=1',
			items:[
				{text:"Biggrin", image:'biggrin', url:'dummy.html?id=2'},
				{text:"Cool", image:'cool', url:'dummy.html?id=3'},
				{text:"Razz", image:'razz', url:'dummy.html?id=4'},
				{text:"Smile", image:'smile', url:'dummy.html?id=5'},
				{text:"Surprised", image:'surprised', url:'dummy.html?id=6'},
				{text:"Wink", image:'wink', url:'dummy.html?id=7'}
			]
		},
		{text:"Other", url:'dummy.html?id=8',
			items:[
				{text:"Confused", image:'confused', url:'dummy.html?id=9'},
				{text:"Doubt", image:'doubt', url:'dummy.html?id=10'},
				{text:"Evil", image:'evil', url:'dummy.html?id=11'},
				{text:"Mad", image:'mad', url:'dummy.html?id=12'},
				{text:"Neutral", image:'neutral', url:'dummy.html?id=13'},
				{text:"Red face", image:'redface', url:'dummy.html?id=14'},
				{text:"Sad", image:'sad', url:'dummy.html?id=15'},
				{text:"Shock", image:'shock', url:'dummy.html?id=16'}
			]
		},
		{text:"Animated", url:'dummy.html?id=17',
			items:[
				{text:"Roll eyes", image:'rolleyes', url:'dummy.html?id=18'},
				{text:"LOL", image:'lol', url:'dummy.html?id=19'},
				{text:"Cry", image:'cry', url:'dummy.html?id=20'},
				{text:"Badgrin", image:'badgrin', url:'dummy.html?id=21'}
			]
		},
		{text:"Misc", url:'dummy.html?id=22',
			items:[
				{text:"Arrow", image:'arrow', url:'dummy.html?id=23'},
				{text:"Question", image:'question', url:'dummy.html?id=24'},
				{text:"Exclamation", image:'exclaim', url:'dummy.html?id=25'},
				{text:"Idea", image:'idea', url:'dummy.html?id=26'}
			]
		}
	]
}
