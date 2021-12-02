USE [SAI_Work2]
GO

/****** Object:  Table [dbo].[ActionButton]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[ActionButton](
	[SysID] [bigint] NOT NULL,
	[Description] [varchar](50) NULL,
	[DocDate] [date] NULL,
	[Status] [bit] NULL,
	[CountX] [float] NULL CONSTRAINT [DF_ActionButton_Count]  DEFAULT ((0))
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[BOM1]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[BOM1](
	[SysID] [varchar](50) NOT NULL,
	[ItemNo] [bigint] NULL,
	[PartNo] [varchar](150) NULL,
	[PartName] [varchar](250) NULL,
	[IDCust] [bigint] NULL,
	[Image] [varchar](100) NULL,
	[IDProject] [bigint] NULL,
	[PackingType] [varchar](50) NULL,
	[PartTypeID] [varchar](5) NULL,
	[StdPack] [float] NULL,
	[FGLocation] [varchar](50) NULL,
	[QtyPerCar] [float] NULL,
	[SupplierID] [bigint] NULL,
	[CreateBy] [bigint] NULL,
	[IsActive] [bit] NULL CONSTRAINT [DF_BOM1_IsActive]  DEFAULT ((1)),
	[IsDelete] [bit] NULL CONSTRAINT [DF_BOM1_IsDelete]  DEFAULT ((0)),
	[NameType] [int] NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[BOM2]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[BOM2](
	[SysID] [varchar](50) NOT NULL,
	[ItemNo] [bigint] NULL,
	[ItemNoSub] [bigint] NULL,
	[NoUrut] [bigint] NULL,
	[LinkID] [varchar](50) NULL,
	[PartNo] [varchar](150) NULL,
	[PartName] [varchar](250) NULL,
	[LevelPart] [bigint] NULL,
	[PartType] [varchar](5) NULL,
	[QtyPerCar] [float] NULL,
	[SupplierID] [bigint] NULL,
	[Spec] [varchar](50) NULL,
	[Thick] [float] NULL,
	[Width] [float] NULL,
	[Length] [float] NULL,
	[PcsPerSheet] [float] NULL,
	[KgPerSheet] [float] NULL,
	[PartWeight] [float] NULL,
	[PcsPerDay] [float] NULL,
	[MaterialType] [bigint] NULL,
	[FGLocation] [varchar](50) NULL,
	[PackingType] [varchar](50) NULL,
	[StdPack] [float] NULL,
	[IsActiveDetail] [bit] NULL DEFAULT ((1)),
	[IsDeleteDetail] [bit] NULL DEFAULT ((0)),
	[SpecOrder1] [varchar](60) NULL,
	[SpecOrder2] [varchar](70) NULL,
	[QtyPart] [float] NULL DEFAULT ((1)),
	[Ratio] [float] NULL DEFAULT ((1)),
	[IsCommon] [bit] NULL DEFAULT ((0)),
	[PartNo_Ext] [varchar](150) NULL,
	[PartName_Ext] [varchar](150) NULL,
	[IsCommonGroup] [bit] NULL DEFAULT ((0)),
	[GroupCommonID] [varchar](50) NULL,
	[NameType] [int] NULL,
	[ItemID] [bigint] NULL,
	[PartNo2] [varchar](150) NULL,
	[IsRHLH] [bit] NULL DEFAULT ((0)),
	[Images] [varchar](50) NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[BOM3]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[BOM3](
	[SysID] [varchar](50) NOT NULL,
	[LinkID] [varchar](50) NULL,
	[OP5M] [varchar](50) NULL,
	[OP10M] [varchar](50) NULL,
	[OP20M] [varchar](50) NULL,
	[OP30M] [varchar](50) NULL,
	[OP40M] [varchar](50) NULL,
	[OP50M] [varchar](50) NULL,
	[OP60M] [varchar](50) NULL,
	[OP70M] [varchar](50) NULL,
	[ItemID] [bigint] NOT NULL,
	[OnProcess] [text] NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[BOM4]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[BOM4](
	[SysID] [varchar](50) NOT NULL,
	[LinkID] [varchar](50) NULL,
	[OP5] [varchar](50) NULL,
	[OP10] [varchar](50) NULL,
	[OP20] [varchar](50) NULL,
	[OP30] [varchar](50) NULL,
	[OP40] [varchar](50) NULL,
	[OP50] [varchar](50) NULL,
	[OP60] [varchar](50) NULL,
	[OP70] [varchar](50) NULL,
	[Category] [varchar](25) NULL,
	[ItemID] [bigint] NOT NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[BOM5]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[BOM5](
	[SysID] [varchar](50) NOT NULL,
	[LinkID] [varchar](50) NULL,
	[ProcessAssy] [varchar](50) NULL,
	[LineAssy] [varchar](50) NULL,
	[ItemID] [bigint] NOT NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[BOM6]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[BOM6](
	[SysID] [varchar](5) NULL,
	[PartType] [varchar](50) NULL,
	[Remark] [varchar](150) NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[BOMBuild]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[BOMBuild](
	[SysID] [bigint] IDENTITY(1254,1) NOT NULL,
	[LinkID] [varchar](50) NULL,
	[ItemID] [bigint] NULL,
	[CreateBy] [bigint] NULL,
	[CreateDate] [date] NULL,
	[CreateTime] [time](7) NULL,
	[IsDelete] [bit] NULL CONSTRAINT [DF_BOMBuild_IsDelete]  DEFAULT ((0)),
 CONSTRAINT [PK_BOMBuild] PRIMARY KEY CLUSTERED
(
	[SysID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[BOMChild]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[BOMChild](
	[SysID] [bigint] IDENTITY(766,1) NOT NULL,
	[ItemID] [bigint] NULL,
	[ItemChild] [bigint] NULL,
 CONSTRAINT [PK_BOMChild] PRIMARY KEY CLUSTERED
(
	[SysID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[BomRM]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[BomRM](
	[SysID] [bigint] IDENTITY(1,1) NOT NULL,
	[ItemID] [bigint] NULL,
	[ItemRM] [bigint] NULL,
 CONSTRAINT [PK_BomRM] PRIMARY KEY CLUSTERED
(
	[SysID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[CMProduct_BOM]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[CMProduct_BOM](
	[SysID] [bigint] IDENTITY(1321,1) NOT NULL,
	[ItemID_Product] [bigint] NULL,
	[ItemID_BOM] [varchar](50) NOT NULL,
	[PartTypeID] [varchar](50) NULL,
 CONSTRAINT [PK_CMProduct_BOM] PRIMARY KEY CLUSTERED
(
	[SysID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[D_Comment]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[D_Comment](
	[idcoment] [bigint] IDENTITY(1,1) NOT NULL,
	[idcoment_detail] [bigint] NULL,
	[kode_com] [varchar](max) NULL,
	[topic] [varchar](max) NULL,
	[coment] [varchar](max) NULL,
	[tgl_in] [date] NULL,
	[username] [varchar](max) NULL,
	[id_dept] [bigint] NULL,
	[foto] [varchar](max) NULL,
	[foto2] [varchar](max) NULL,
	[jam] [time](0) NULL,
	[LikeCom] [float] NULL,
	[QtyComent] [float] NULL,
	[FitureID] [int] NULL,
 CONSTRAINT [PK_D_Comment] PRIMARY KEY CLUSTERED
(
	[idcoment] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[G_DocNumMat]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[G_DocNumMat](
	[RegID] [bigint] IDENTITY(1,1) NOT NULL,
	[DocNum] [varchar](max) NULL,
	[CreateBy] [bigint] NULL,
	[CreateDate] [datetime] NULL CONSTRAINT [DF__G_DocNumM__Creat__14270015]  DEFAULT (getdate()),
	[DocDate] [date] NULL,
	[HideH] [varchar](max) NULL,
	[ItemID] [bigint] NULL,
	[ProsesH] [bigint] NULL,
	[ShiftID] [bigint] NULL,
	[GTStroke] [float] NULL,
	[GTStrokePlan] [float] NULL,
	[TrcTypeID] [bigint] NULL,
	[TrcID] [bigint] NULL,
	[MonthID] [varchar](4) NULL,
 CONSTRAINT [PK_G_DocNumMat] PRIMARY KEY CLUSTERED
(
	[RegID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[LastAct]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[LastAct](
	[SysID] [bigint] NULL,
	[Url] [varchar](150) NULL,
	[HeadMenuActive] [varchar](50) NULL,
	[MenuActive] [varchar](50) NULL,
	[IconActive] [varchar](50) NULL,
	[IP_address] [varchar](50) NULL,
	[Status] [bit] NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[LogUser]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[LogUser](
	[SysID] [bigint] IDENTITY(1,1) NOT NULL,
	[UserName] [varchar](150) NULL,
	[DocDate] [date] NULL,
	[DocTime] [time](0) NULL,
	[Query] [varchar](150) NULL,
	[IP_address] [varchar](50) NULL,
	[Status] [bit] NULL,
PRIMARY KEY CLUSTERED
(
	[SysID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_AddressDlv]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[M_AddressDlv](
	[SysID] [int] IDENTITY(80,1) NOT NULL,
	[PartnerID] [int] NULL,
	[TitleAddres] [nvarchar](20) NULL,
	[Address] [nvarchar](200) NULL,
	[City] [nvarchar](50) NULL,
	[PostCode] [nvarchar](50) NULL,
	[Country] [nvarchar](50) NULL,
	[CurrencyID] [int] NULL,
	[PricePeriodActiveID] [int] NULL,
	[IsBilling] [bit] NULL,
	[IsOffice] [bit] NULL,
	[IsDelivery] [bit] NULL,
	[Phone] [nvarchar](50) NULL,
	[Fax] [nvarchar](50) NULL,
 CONSTRAINT [M_AddressDlv_pk] PRIMARY KEY CLUSTERED
(
	[SysID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[M_Asset]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_Asset](
	[SysID] [bigint] NOT NULL,
	[ItemID] [varchar](50) NULL,
	[ItemNo] [varchar](max) NULL,
	[ItemName] [varchar](100) NULL,
	[Spec] [varchar](150) NULL,
	[CategoryID] [bigint] NULL,
	[Remark] [text] NULL,
	[LocationID] [bigint] NULL,
	[UserID] [bigint] NULL,
	[DatePur] [date] NULL,
	[LastUpdate] [date] NULL,
	[PurchaseDate] [date] NULL,
	[VendorID] [bigint] NULL,
	[Qty] [float] NULL,
	[QtyBal] [float] NULL,
	[JurnalID] [varchar](50) NULL,
	[UnitID] [bigint] NULL,
	[Image] [varchar](150) NULL,
	[ImageRev] [float] NULL,
	[IsActive] [bit] NULL,
	[Price] [float] NULL,
	[Amount] [float] NULL,
 CONSTRAINT [PK_M_Asset] PRIMARY KEY CLUSTERED
(
	[SysID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_AssetICT]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_AssetICT](
	[SysID] [varchar](150) NULL,
	[RAM] [bigint] NULL,
	[HDD] [bigint] NULL,
	[NetCard] [bigint] NULL,
	[VGACard] [bigint] NULL,
	[Processor] [bigint] NULL,
	[OS] [bigint] NULL,
	[Office] [bigint] NULL,
	[Autocad] [bigint] NULL,
	[NX] [bigint] NULL,
	[SW] [bigint] NULL,
	[Catia] [bigint] NULL,
	[FB] [bigint] NULL,
	[DB] [bigint] NULL,
	[Hardware] [bigint] NULL,
	[PrinterType] [bigint] NULL,
	[ColorType] [bigint] NULL,
	[SizePaper] [bigint] NULL,
	[Remark] [varchar](max) NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_Bank]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[M_Bank](
	[SysID] [smallint] NULL,
	[Code] [nvarchar](10) NULL,
	[BankName] [nvarchar](50) NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[M_Category]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_Category](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[code] [varchar](25) NULL,
	[category_name] [varchar](100) NULL,
	[descr] [varchar](max) NULL,
	[GroupBy] [varchar](50) NULL,
	[IsDelete] [varchar](1) NULL CONSTRAINT [DF_M_Category_IsDelete]  DEFAULT ('X'),
 CONSTRAINT [PK_M_Category] PRIMARY KEY CLUSTERED
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_ChildPart_Conecting]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_ChildPart_Conecting](
	[SysID] [bigint] IDENTITY(10,1) NOT NULL,
	[ItemID] [bigint] NULL,
	[ChildPartID] [varchar](50) NOT NULL,
	[PartTypeID] [varchar](50) NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_Currency]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[M_Currency](
	[SysID] [int] NULL,
	[Code] [nvarchar](5) NULL,
	[Descr] [nvarchar](50) NULL,
	[Desimal] [smallint] NULL,
	[Desimal2] [smallint] NULL,
	[TitikKoma] [smallint] NULL,
	[Rate] [float] NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[M_Customer]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_Customer](
	[RegID] [bigint] IDENTITY(38,1) NOT NULL,
	[Code] [varchar](max) NULL,
	[CustName] [varchar](max) NULL,
	[IsDelete] [nchar](10) NULL,
 CONSTRAINT [PK_M_Customer] PRIMARY KEY CLUSTERED
(
	[RegID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_Department]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_Department](
	[id] [bigint] IDENTITY(30,1) NOT NULL,
	[Dept_Code] [varchar](max) NULL,
	[Dept_Name] [varchar](max) NULL,
	[Descr] [varchar](max) NULL,
	[DeptSysID] [bigint] NULL,
 CONSTRAINT [PK_M_Department] PRIMARY KEY CLUSTERED
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_DetailICT]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_DetailICT](
	[SysID] [bigint] IDENTITY(1,1) NOT NULL,
	[Code] [varchar](50) NULL,
	[Description] [varchar](50) NULL,
	[Category] [varchar](50) NULL,
	[Remark] [varchar](50) NULL,
	[IsDelete] [bit] NULL,
 CONSTRAINT [PK_M_DetailICT] PRIMARY KEY CLUSTERED
(
	[SysID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_DetailStatus]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_DetailStatus](
	[RegID] [bigint] IDENTITY(1,1) NOT NULL,
	[Detail] [varchar](50) NULL,
 CONSTRAINT [PK_M_DetailStatus] PRIMARY KEY CLUSTERED
(
	[RegID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_Jabatan]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_Jabatan](
	[RegID] [int] IDENTITY(1,1) NOT NULL,
	[LevelName] [varchar](150) NULL,
PRIMARY KEY CLUSTERED
(
	[RegID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_Level]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[M_Level](
	[id_level] [bigint] IDENTITY(1,1) NOT NULL,
	[level] [nvarchar](50) NULL,
 CONSTRAINT [PK_M_Level] PRIMARY KEY CLUSTERED
(
	[id_level] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[M_Line]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_Line](
	[IDLine] [bigint] IDENTITY(1,1) NOT NULL,
	[Line] [nvarchar](150) NULL,
	[Category] [varchar](50) NULL,
	[Factory] [nchar](10) NULL,
 CONSTRAINT [PK_M_Line] PRIMARY KEY CLUSTERED
(
	[IDLine] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_Location]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_Location](
	[SysID] [bigint] IDENTITY(1,1) NOT NULL,
	[Location] [varchar](50) NULL,
	[Remark] [varchar](50) NULL,
	[Category] [varchar](50) NULL,
	[IsActive] [bit] NULL,
 CONSTRAINT [PK_M_Location] PRIMARY KEY CLUSTERED
(
	[SysID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_Machine]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[M_Machine](
	[RegID] [bigint] IDENTITY(1,1) NOT NULL,
	[Code] [nvarchar](50) NULL,
	[McName] [nvarchar](50) NULL,
	[Tonage] [float] NULL,
	[IDLine] [bigint] NULL,
	[DetailLine] [bigint] NULL,
	[IsActive] [bigint] NULL,
 CONSTRAINT [PK_M_Machine] PRIMARY KEY CLUSTERED
(
	[RegID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[M_MasterBy]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_MasterBy](
	[RegID] [bigint] IDENTITY(10,1) NOT NULL,
	[MasterBy] [varchar](50) NULL,
 CONSTRAINT [PK_M_MasterBy] PRIMARY KEY CLUSTERED
(
	[RegID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_MaterialType]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_MaterialType](
	[RegID] [bigint] IDENTITY(1,1) NOT NULL,
	[MaterialName] [varchar](50) NULL,
 CONSTRAINT [PK_M_MaterialType] PRIMARY KEY CLUSTERED
(
	[RegID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_Partner]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[M_Partner](
	[SysID] [bigint] IDENTITY(1,1) NOT NULL,
	[PartnerCode] [nvarchar](50) NULL,
	[PartnerName] [nvarchar](100) NULL,
	[Address] [nvarchar](150) NULL,
	[TermOfPayment] [int] NULL,
	[IsPPN] [bit] NULL CONSTRAINT [DF__T010_Part__IsPPN__084B3915]  DEFAULT ((1)),
	[NPWP] [nvarchar](50) NULL,
	[EmailAddress] [nvarchar](50) NULL,
	[IsCustomer] [bit] NULL,
	[IsVendor] [bit] NULL,
	[IsSubcont] [bit] NULL,
	[CurrencyID] [int] NULL,
	[PricePeriodActiveID] [int] NULL,
	[Telp] [nvarchar](50) NULL,
	[Fax] [nvarchar](50) NULL,
	[PICName] [nvarchar](50) NULL,
	[MayPrintInv] [bit] NULL CONSTRAINT [DF__T010_Part__MayPr__093F5D4E]  DEFAULT ((0)),
	[RepeatPrint] [smallint] NULL,
	[CreditLimit] [float] NULL,
	[CreditLimitActive] [bit] NULL,
	[NoRek] [nvarchar](50) NULL,
	[BankNameID] [smallint] NULL,
	[Cabang] [nvarchar](50) NULL,
	[AtasNama] [nvarchar](50) NULL,
	[IsDelete] [bit] NULL CONSTRAINT [DF__T010_Part__IsDel__0A338187]  DEFAULT ((0))
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[M_Partner2]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_Partner2](
	[id] [bigint] IDENTITY(11051,1) NOT NULL,
	[partner_code] [varchar](max) NULL,
	[partner_name] [varchar](max) NULL,
	[address] [varchar](max) NULL,
	[dlvaddress] [text] NULL,
	[telp] [varchar](max) NULL,
	[IsDelete] [nchar](10) NULL,
	[Category] [varchar](50) NULL,
 CONSTRAINT [PK_M_Partner] PRIMARY KEY CLUSTERED
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_Product]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_Product](
	[RegID] [bigint] IDENTITY(1,1) NOT NULL,
	[PartNo] [varchar](50) NULL,
	[PartName] [varchar](max) NULL,
	[Spec1] [varchar](50) NULL,
	[Spec2] [varchar](50) NULL,
	[PcsPerSheet] [float] NULL,
	[PcsPerKg] [float] NULL,
	[IDCust] [bigint] NULL,
	[IDProject] [bigint] NULL,
	[IDCategory] [bigint] NULL,
	[IsMaterial] [bigint] NULL,
	[IsStamping] [bigint] NULL,
	[IsWelding] [bigint] NULL,
	[IsDelivery] [bigint] NULL,
	[IsStoreRoom] [bigint] NULL,
	[IsActive] [bigint] NULL,
	[Price] [float] NULL,
	[PcsPerday] [float] NULL,
	[Min] [float] NULL,
	[Max] [float] NULL,
	[DocDate] [date] NULL,
	[UpdateBy] [bigint] NULL,
	[MaterialType] [bigint] NULL,
	[StockFG] [float] NULL,
	[Image] [varchar](max) NULL,
	[StockWip] [float] NULL,
	[MasterBy] [bigint] NULL,
	[IDUnit] [bigint] NULL,
	[IDUnit_Buy] [bigint] NULL,
	[IsICT] [bigint] NULL,
	[IsGA] [bigint] NULL,
	[StockWIP2] [float] NULL,
	[IsWIP] [smallint] NULL,
	[Sparating] [float] NULL,
	[StdPack] [float] NULL,
	[IsSubcon] [bit] NULL,
	[IsDelete] [varchar](1) NULL CONSTRAINT [DF_M_Product_IsDelete]  DEFAULT ('X'),
	[Convertion] [float] NULL CONSTRAINT [DF_M_Product_Convertion]  DEFAULT ((0)),
	[CurrencyID] [bigint] NULL,
	[JobNum] [varchar](150) NULL,
	[Description] [varchar](150) NULL,
	[IsG5] [bit] NULL CONSTRAINT [DF_M_Product_IsG5]  DEFAULT ((0)),
	[PostCategoryID] [int] NULL,
 CONSTRAINT [PK_M_Product] PRIMARY KEY CLUSTERED
(
	[RegID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_ProductionProcess]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_ProductionProcess](
	[SysID] [bigint] IDENTITY(1,1) NOT NULL,
	[Code] [varchar](50) NULL,
	[Description] [varchar](50) NULL,
	[Category] [varchar](50) NULL,
	[IsDelete] [varchar](1) NULL,
 CONSTRAINT [PK_M_ProductionProcess] PRIMARY KEY CLUSTERED
(
	[SysID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_Project]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_Project](
	[RegID] [bigint] IDENTITY(10014,1) NOT NULL,
	[IDCust] [bigint] NULL,
	[ProjectName] [varchar](50) NULL,
 CONSTRAINT [PK_M_Project] PRIMARY KEY CLUSTERED
(
	[RegID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_QCCheck]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_QCCheck](
	[SysID] [bigint] IDENTITY(1,1) NOT NULL,
	[QCCheck] [varchar](50) NULL,
	[Category] [varchar](50) NULL,
 CONSTRAINT [PK_M_QCCheck] PRIMARY KEY CLUSTERED
(
	[SysID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_Shift2]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_Shift2](
	[SysID] [bigint] IDENTITY(1,1) NOT NULL,
	[CodeShift] [varchar](1) NULL,
	[Shift] [varchar](50) NULL,
 CONSTRAINT [PK_M_Shift2] PRIMARY KEY CLUSTERED
(
	[SysID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_Shipper]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[M_Shipper](
	[SysID] [smallint] NULL,
	[Shipper] [nvarchar](50) NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[M_Unit]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_Unit](
	[id] [bigint] NOT NULL,
	[code] [varchar](90) NULL,
	[unit] [varchar](180) NULL,
	[descr] [varchar](180) NULL,
	[IsDelete] [varchar](1) NULL,
 CONSTRAINT [PK_M_Unit] PRIMARY KEY CLUSTERED
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_User]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_User](
	[RegID] [bigint] IDENTITY(1,1) NOT NULL,
	[Code] [varchar](50) NULL,
	[username] [nvarchar](150) NULL,
	[id_user] [nvarchar](150) NULL,
	[password] [nvarchar](150) NULL,
	[nama_lengkap] [varchar](max) NULL,
	[level] [nvarchar](60) NULL,
	[blokir] [nvarchar](3) NULL,
	[foto] [nvarchar](150) NULL,
	[id_dept] [bigint] NULL,
	[password2] [nvarchar](150) NULL,
	[IsStoreRoom] [bigint] NULL,
	[MUserTR] [bigint] NULL,
	[MUser] [bigint] NULL,
	[MProdMaterial] [bigint] NULL,
	[MProdStamping] [bigint] NULL,
	[MProdWelding] [bigint] NULL,
	[MProdDelivery] [bigint] NULL,
	[MProdStoreRoom] [bigint] NULL,
	[MPartner] [bigint] NULL,
	[MCategory] [bigint] NULL,
	[MUnit] [bigint] NULL,
	[MCust] [bigint] NULL,
	[TrcMaterial] [bigint] NULL,
	[TrcStamping] [bigint] NULL,
	[TrcWelding] [bigint] NULL,
	[TrcWH] [bigint] NULL,
	[TrcStoreRoom] [bigint] NULL,
	[TrcGA] [bigint] NULL,
	[TrcMTC] [bigint] NULL,
	[TrcICT] [bigint] NULL,
	[CanEditMaster] [bigint] NULL,
	[CanEditDoc] [bigint] NULL,
	[CanEditManUser] [bigint] NULL,
	[MProdICT] [bigint] NULL,
	[MProdMTNT] [bigint] NULL,
	[MProdMTNM] [bigint] NULL,
	[MProdGA] [bigint] NULL,
	[TrcMTNM] [bigint] NULL,
	[TrcMTNT] [bigint] NULL,
	[TrcAsset] [bit] NULL,
	[CanEditDocAdmin] [bigint] NULL,
	[MProduct] [bigint] NULL,
	[MUtility] [bigint] NULL,
	[MUserIMS] [bigint] NULL,
	[TrcWIP] [bigint] NULL,
	[IsDelete] [nchar](10) NULL,
	[Email] [varchar](150) NULL,
	[ActivationID] [varchar](250) NULL,
	[Activation] [bigint] NULL,
	[MAsset] [bit] NULL,
	[MBom] [bit] NULL,
	[TrcSony] [bit] NULL,
	[TrcProduction] [bit] NULL,
	[DailyGAP] [bit] NULL,
	[TrcBPFG] [bit] NULL,
	[area] [bigint] NULL,
 CONSTRAINT [PK_M_User] PRIMARY KEY CLUSTERED
(
	[RegID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_UserG5]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_UserG5](
	[SysID] [bigint] IDENTITY(133,1) NOT NULL,
	[RegID] [bigint] NULL,
	[UserName] [varchar](50) NULL,
	[FullName] [varchar](50) NULL,
	[DeptID] [bigint] NULL,
	[Password] [varchar](150) NULL,
	[PasswordX] [varchar](150) NULL,
	[Image] [varchar](50) NULL CONSTRAINT [DF_M_UserG5_Image]  DEFAULT ('ico_users_64.png'),
	[Email] [varchar](150) NULL,
	[IsActive] [bit] NULL,
	[IsStoreRoom] [bit] NULL,
	[ActivationID] [varchar](250) NULL,
	[Activation] [bit] NULL,
	[Area] [varchar](50) NULL,
	[Pin] [varchar](max) NULL,
	[Signature] [varchar](max) NULL,
	[JabatanID] [int] NULL,
 CONSTRAINT [PK_M_UserG5] PRIMARY KEY CLUSTERED
(
	[SysID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_UserRole]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_UserRole](
	[SysID] [bigint] IDENTITY(1,1) NOT NULL,
	[UserID] [bigint] NULL,
	[NumOf] [bigint] NULL,
	[ActivityID] [bigint] NULL,
	[Activity] [varchar](50) NULL,
	[ActivityCode] [varchar](50) NULL,
	[DelData] [bit] NULL,
	[UpData] [bit] NULL,
	[RetData] [bit] NULL,
	[ViewJurnal] [bit] NULL,
	[UserGroupFlow] [bigint] NULL,
 CONSTRAINT [PK_M_UserRole] PRIMARY KEY CLUSTERED
(
	[SysID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[M_Vendor]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[M_Vendor](
	[RegID] [bigint] IDENTITY(1,1) NOT NULL,
	[vendorcode] [varchar](50) NULL,
	[vendorname] [varchar](125) NULL,
PRIMARY KEY CLUSTERED
(
	[RegID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[mytable]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[mytable](
	[logins] [int] NULL,
	[logins22] [int] NULL,
	[logins221] [int] NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[PR_DocType]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[PR_DocType](
	[SysID] [smallint] NULL,
	[DocType] [nvarchar](10) NULL,
	[Descr] [nvarchar](50) NULL,
	[TrcTypeID] [smallint] NULL,
	[DeptID] [smallint] NULL,
	[Approval] [nvarchar](20) NULL,
	[Legalized] [nvarchar](20) NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T_30_ActMgr]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[T_30_ActMgr](
	[SysID] [bigint] IDENTITY(143,1) NOT NULL,
	[ObjTitle] [varchar](50) NULL,
	[CodeName] [varchar](50) NULL,
PRIMARY KEY CLUSTERED
(
	[SysID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[T_30_UserGrpFlow]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T_30_UserGrpFlow](
	[SysID] [smallint] NULL,
	[BProcID] [smallint] NULL,
	[Descr] [nvarchar](50) NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T_500_HistoryIMS]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T_500_HistoryIMS](
	[SysID] [bigint] IDENTITY(1,1) NOT NULL,
	[C010_TrcTypeID] [int] NULL,
	[C011_Month] [smallint] NULL,
	[C000_SysID] [int] NULL,
	[C050_Rev] [smallint] NULL,
	[C013_TrcTypeSrcID] [smallint] NULL,
	[C013_DraftReadyApprCancel] [smallint] NULL,
	[C014_ActMgrID] [smallint] NULL,
	[C017_UserGrpFlowID_From] [smallint] NULL,
	[C017_UserGrpFlowID_To] [smallint] NULL,
	[C017_UserGrpFlowFrom] [nvarchar](25) NULL,
	[C017_UserGrpFlowTo] [nvarchar](25) NULL,
	[C018_FlowTypeID] [smallint] NULL,
	[C018_KanbanPostID] [smallint] NULL,
	[C045_UserID] [int] NULL,
	[C045_UserName] [nvarchar](25) NULL,
	[C045_DTime] [datetime] NULL,
	[C045_UserNameUpdate] [nvarchar](25) NULL,
	[C045_DTimeLasUpdate] [datetime] NULL,
	[C050_DocNum] [nvarchar](25) NULL,
	[C050_DocDate] [smalldatetime] NULL,
	[C050_AccountDate] [smalldatetime] NULL,
	[C050_ExtDocNum] [nvarchar](50) NULL,
	[C050_ExtDocDate] [smalldatetime] NULL,
	[C050_ExtDocNum1] [nvarchar](25) NULL,
	[C050_ExtDocDate1] [smalldatetime] NULL,
	[C051_PONum] [nvarchar](30) NULL,
	[C051_FakturNum] [nvarchar](100) NULL,
	[C051_FakturDateTax] [smalldatetime] NULL,
	[C051_DueDate] [smalldatetime] NULL,
	[C052_TermOfPayment] [smallint] NULL,
	[C059_Remark] [nvarchar](1000) NULL,
	[C060_PartnerID] [smallint] NULL,
	[C061_PICName] [nvarchar](50) NULL,
	[C062_ActFixedAssetID] [int] NULL,
	[C070_CurrencyID] [smallint] NULL,
	[C071_Rate] [float] NULL,
	[C072_RateTax] [float] NULL,
	[C073_Amount] [float] NULL,
	[C073_AmountBruto] [float] NULL,
	[C074_AmountDiscount] [float] NULL,
	[C074_Expense] [float] NULL,
	[C075_AmountPpn] [float] NULL,
	[C075_AmountPph] [float] NULL,
	[C076_AmountFinal] [float] NULL,
	[C077_AmountBalance] [float] NULL,
	[C078_AmountPrepaid] [float] NULL,
	[C079_AmountGRNotInv] [float] NULL,
	[C080_PRCategoryID] [smallint] NULL,
	[C085_isPPN] [bit] NULL,
	[C090_EstDlvDate] [smalldatetime] NULL,
	[C113_PRType] [smallint] NULL,
	[SLedgerID] [smallint] NULL,
	[MLedgerID] [smallint] NULL,
	[SubLedger1ID] [smallint] NULL,
	[SubLedger2ID] [smallint] NULL,
	[PostCategoryID] [smallint] NULL,
	[Remark_PR] [nvarchar](1000) NULL,
	[YearIdx] [smallint] NULL,
	[DeptID] [smallint] NULL,
PRIMARY KEY CLUSTERED
(
	[SysID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T_510_HistoryIMS]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T_510_HistoryIMS](
	[SysID] [bigint] IDENTITY(1,1) NOT NULL,
	[C010_TrcTypeID] [int] NULL,
	[C011_Month] [smallint] NULL,
	[C012_TrcID] [int] NULL,
	[C050_Rev] [smallint] NULL,
	[C000_SysID] [int] NULL,
	[C000_LineSrc] [int] NULL,
	[C063_dtDelivery] [smalldatetime] NULL,
	[C100_ItemIntID] [int] NULL,
	[C100_ItemExtID] [int] NULL,
	[C100_ItemNameUser] [nvarchar](200) NULL,
	[C105_Note] [nvarchar](50) NULL,
	[C102_PriceInt] [float] NULL,
	[C110_Qty] [float] NULL,
	[C110_Qty2] [float] NULL,
	[C111_QtyBal] [float] NULL,
	[C125_AmountInt] [float] NULL,
	[C126_ValDiscount] [float] NULL,
	[C127_AmountDiscount] [float] NULL,
	[C130_MLedgerID] [smallint] NULL,
	[C131_SubLedger1ID] [smallint] NULL,
	[C132_SubLedger2ID] [smallint] NULL,
	[C135_Rate] [float] NULL,
	[C140_KategoryID] [smallint] NULL,
	[C150_UnitConvertion] [float] NULL,
	[C160_PRType] [smallint] NULL,
	[PostCategoryID] [smallint] NULL,
	[C128_NetAmount] [float] NULL,
	[CostCenterID] [smallint] NULL,
PRIMARY KEY CLUSTERED
(
	[SysID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T_76_SLedger]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T_76_SLedger](
	[SysID] [smallint] NULL,
	[Code] [nvarchar](10) NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T_77_MLedger]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T_77_MLedger](
	[SysID] [smallint] NULL,
	[Code] [nvarchar](50) NULL,
	[Descr] [nvarchar](100) NULL,
	[SeqIdx] [smallint] NULL,
	[MAcctLevel] [smallint] NULL,
	[TypeML] [smallint] NULL,
	[CF_rptType] [smallint] NULL,
	[CF_Group] [nchar](10) NULL,
	[BS_rptType] [smallint] NULL,
	[PL_rptType] [smallint] NULL,
	[TB_Group] [smallint] NULL,
	[Spasi] [nchar](10) NULL,
	[IsDetail] [bit] NULL,
	[IsNeraca] [bit] NULL,
	[ParentID] [smallint] NULL,
	[Lft] [smallint] NULL,
	[Rgt] [smallint] NULL,
	[parTopID] [int] NULL,
	[KasCnt] [bit] NULL,
	[KasBankCnt] [bit] NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T_77_MLedger_Sub1]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T_77_MLedger_Sub1](
	[SysID] [smallint] NULL,
	[MLedgerID] [smallint] NULL,
	[Code] [nvarchar](50) NULL,
	[Descr] [nvarchar](100) NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T_77_MLedger_Sub2]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T_77_MLedger_Sub2](
	[SysID] [smallint] NULL,
	[MLedgerID] [smallint] NULL,
	[SubLedgerID] [smallint] NULL,
	[Code] [nvarchar](20) NULL,
	[Descr] [nvarchar](50) NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T_Connecting]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T_Connecting](
	[TrcTypeID] [bigint] NULL,
	[MonthID] [bigint] NULL,
	[TrcID] [bigint] NULL,
	[LineID] [bigint] NULL,
	[TrcTypeID_To] [bigint] NULL,
	[MonthID_To] [bigint] NULL,
	[TrcID_To] [bigint] NULL,
	[LineID_To] [bigint] NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T015_Department]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T015_Department](
	[SysID] [smallint] NULL,
	[Department] [nvarchar](50) NULL,
	[DeptGroup] [nvarchar](20) NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T040_AddressDlv]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T040_AddressDlv](
	[SysID] [int] NULL,
	[PartnerID] [int] NULL,
	[TitleAddres] [nvarchar](20) NULL,
	[Address] [nvarchar](200) NULL,
	[City] [nvarchar](50) NULL,
	[PostCode] [nvarchar](50) NULL,
	[Country] [nvarchar](50) NULL,
	[CurrencyID] [int] NULL,
	[PricePeriodActiveID] [int] NULL,
	[IsBilling] [bit] NULL,
	[IsOffice] [bit] NULL,
	[IsDelivery] [bit] NULL,
	[Phone] [nvarchar](50) NULL,
	[Fax] [nvarchar](50) NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T064_PRCategory]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T064_PRCategory](
	[SysID] [smallint] NULL,
	[TrcTypeID] [smallint] NULL,
	[Sub1] [nvarchar](50) NULL,
	[Sub2] [nvarchar](50) NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T064_PRType]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T064_PRType](
	[TrcTypeID] [smallint] NULL,
	[PRType] [nvarchar](50) NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T066_ItemGroup]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T066_ItemGroup](
	[SysID] [smallint] NULL,
	[ItemGroup] [nvarchar](60) NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T077_PostCategory]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T077_PostCategory](
	[SysID] [smallint] NULL,
	[DocTypeID] [smallint] NULL,
	[PostCategory] [nvarchar](80) NULL,
	[MLedgerID] [smallint] NULL,
	[TrcTypeID] [smallint] NULL,
	[ItemGroupID] [smallint] NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T093_CostCenter]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T093_CostCenter](
	[SysID] [smallint] NULL,
	[YearIdx] [smallint] NULL,
	[DeptID] [smallint] NULL,
	[Budget] [float] NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T094_CostCenterDetail]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T094_CostCenterDetail](
	[SysID] [int] NULL,
	[CostCenterID] [smallint] NULL,
	[ItemGroupID] [smallint] NULL,
	[Descr] [nvarchar](50) NULL,
	[Nominal] [float] NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T100_FixedAsset]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T100_FixedAsset](
	[SysID] [int] NULL,
	[Code] [nvarchar](50) NULL,
	[Descr] [nvarchar](200) NULL,
	[GroupAssetID] [smallint] NULL,
	[Activity_ActiveID] [smallint] NULL,
	[Activate] [bit] NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T101_GroupAsset]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T101_GroupAsset](
	[SysID] [smallint] NULL,
	[Code] [nvarchar](20) NULL,
	[Descr] [nvarchar](50) NULL,
	[MLedgerID_D] [smallint] NULL,
	[MLedgerID_K] [smallint] NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T105_ActivityCategory]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T105_ActivityCategory](
	[SysID] [smallint] NULL,
	[Code] [nvarchar](20) NULL,
	[Descr] [nvarchar](50) NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T106_FA_Activity]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T106_FA_Activity](
	[SysID] [int] NULL,
	[FixedAssetID] [int] NULL,
	[ActivityCategoryID] [smallint] NULL,
	[dtCreate] [smalldatetime] NULL,
	[dtAcc] [smalldatetime] NULL,
	[UserID] [smallint] NULL,
	[OwnerID] [smallint] NULL,
	[User_UE] [smallint] NULL,
	[StatProgress] [smallint] NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T500_500]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T500_500](
	[C010_TrcTypeID] [smallint] NULL,
	[C011_Month] [smallint] NULL,
	[C000_SysID] [smallint] NULL,
	[C050_Rev] [smallint] NULL,
	[C013_TrcTypeSrcID] [smallint] NULL,
	[C018_FlowTypeID] [smallint] NULL,
	[C034_TrcTypeID_To] [smallint] NULL,
	[C035_Month_To] [smallint] NULL,
	[C036_TrcID_To] [smallint] NULL,
	[C050_Rev_To] [smallint] NULL,
	[C016_ContentFlowID] [smallint] NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T500_AsSource]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T500_AsSource](
	[C010_TrcTypeID] [smallint] NULL,
	[C011_Month] [smallint] NULL,
	[C000_SysID] [int] NULL,
	[C050_Rev] [smallint] NULL,
	[C012_TrcOpenClose] [smallint] NULL DEFAULT ((1)),
	[C012_dtLocked] [datetime] NULL,
	[C012_LockUser] [int] NULL,
	[C012_Responded] [smallint] NULL DEFAULT ((1)),
	[C013_TrcTypeSrcID] [smallint] NULL,
	[C014_ActMgrID] [smallint] NULL,
	[C016_ContentFlowID] [smallint] NULL,
	[C017_UserGrpFlowID] [smallint] NULL,
	[C018_FlowTypeID] [smallint] NULL,
	[C019_ActMgrDestID] [smallint] NULL,
	[C045_UserID] [int] NULL,
	[C045_DTime] [datetime] NULL,
	[C050_DocNum] [nvarchar](25) NULL,
	[C050_DocDate] [smalldatetime] NULL,
	[C060_PartnerID] [smallint] NULL,
	[UserMarkingID] [int] NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T500_LastAct]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T500_LastAct](
	[C010_TrcTypeID] [int] NULL,
	[C011_Month] [smallint] NULL,
	[C000_SysID] [int] NULL,
	[C050_Rev] [smallint] NULL,
	[C045_UserID] [int] NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T500_Node]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T500_Node](
	[C010_TrcTypeID] [int] NULL,
	[C011_Month] [smallint] NULL,
	[C000_SysID] [int] NULL,
	[C050_Rev] [smallint] NULL,
	[C013_TrcTypeSrcID] [smallint] NULL,
	[C013_DraftReadyApprCancel] [smallint] NULL,
	[C014_ActMgrID] [smallint] NULL,
	[C017_UserGrpFlowID_From] [smallint] NULL,
	[C017_UserGrpFlowID_To] [smallint] NULL,
	[C017_UserGrpFlowFrom] [nvarchar](25) NULL,
	[C017_UserGrpFlowTo] [nvarchar](25) NULL,
	[C018_FlowTypeID] [smallint] NULL,
	[C018_KanbanPostID] [smallint] NULL,
	[C020_NodeHistoryID_Active] [smallint] NULL,
	[C045_UserID] [int] NULL,
	[C045_UserName] [nvarchar](25) NULL,
	[C045_DTime] [datetime] NULL,
	[C045_UserNameUpdate] [nvarchar](25) NULL,
	[C045_DTimeLasUpdate] [datetime] NULL,
	[C050_DocNum] [nvarchar](25) NULL,
	[C050_DocDate] [smalldatetime] NULL,
	[C050_AccountDate] [smalldatetime] NULL,
	[C050_ExtDocNum] [nvarchar](50) NULL,
	[C050_ExtDocDate] [smalldatetime] NULL,
	[C060_PartnerID] [smallint] NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T500_Proc]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T500_Proc](
	[C010_TrcTypeID] [int] NULL,
	[C011_Month] [smallint] NULL,
	[C000_SysID] [int] NULL,
	[C050_Rev] [smallint] NULL,
	[C013_TrcTypeSrcID] [smallint] NULL,
	[C013_DraftReadyApprCancel] [smallint] NULL,
	[C014_ActMgrID] [smallint] NULL,
	[C017_UserGrpFlowID_From] [smallint] NULL,
	[C017_UserGrpFlowID_To] [smallint] NULL,
	[C017_UserGrpFlowFrom] [nvarchar](25) NULL,
	[C017_UserGrpFlowTo] [nvarchar](25) NULL,
	[C018_FlowTypeID] [smallint] NULL,
	[C018_KanbanPostID] [smallint] NULL,
	[C045_UserID] [int] NULL,
	[C045_UserName] [nvarchar](25) NULL,
	[C045_DTime] [datetime] NULL,
	[C045_UserNameUpdate] [nvarchar](25) NULL,
	[C045_DTimeLasUpdate] [datetime] NULL,
	[C050_DocNum] [nvarchar](25) NULL,
	[C050_DocDate] [smalldatetime] NULL,
	[C050_AccountDate] [smalldatetime] NULL,
	[C050_ExtDocNum] [nvarchar](50) NULL,
	[C050_ExtDocDate] [smalldatetime] NULL,
	[C050_ExtDocNum1] [nvarchar](25) NULL,
	[C050_ExtDocDate1] [smalldatetime] NULL,
	[C051_PONum] [nvarchar](30) NULL,
	[C051_FakturNum] [nvarchar](100) NULL,
	[C051_FakturDateTax] [smalldatetime] NULL,
	[C051_DueDate] [smalldatetime] NULL,
	[C052_TermOfPayment] [smallint] NULL,
	[C059_Remark] [nvarchar](1000) NULL,
	[C060_PartnerID] [smallint] NULL,
	[C061_PICName] [nvarchar](50) NULL,
	[C062_ActFixedAssetID] [int] NULL,
	[C070_CurrencyID] [smallint] NULL,
	[C071_Rate] [float] NULL,
	[C072_RateTax] [float] NULL,
	[C073_Amount] [float] NULL,
	[C073_AmountBruto] [float] NULL,
	[C074_AmountDiscount] [float] NULL,
	[C074_Expense] [float] NULL,
	[C075_AmountPpn] [float] NULL,
	[C075_AmountPph] [float] NULL,
	[C076_AmountFinal] [float] NULL,
	[C077_AmountBalance] [float] NULL,
	[C078_AmountPrepaid] [float] NULL,
	[C079_AmountGRNotInv] [float] NULL,
	[C080_PRCategoryID] [smallint] NULL,
	[C085_isPPN] [bit] NULL,
	[C090_EstDlvDate] [smalldatetime] NULL,
	[C113_PRType] [smallint] NULL,
	[SLedgerID] [smallint] NULL,
	[MLedgerID] [smallint] NULL,
	[SubLedger1ID] [smallint] NULL,
	[SubLedger2ID] [smallint] NULL,
	[PostCategoryID] [smallint] NULL,
	[Remark_PR] [nvarchar](1000) NULL,
	[YearIdx] [smallint] NULL,
	[DeptID] [smallint] NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T500_Temp]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T500_Temp](
	[C010_TrcTypeID] [int] NULL,
	[C011_Month] [smallint] NULL,
	[C000_SysID] [int] NULL,
	[C050_Rev] [smallint] NULL,
	[C013_TrcTypeSrcID] [smallint] NULL,
	[C013_DraftReadyApprCancel] [smallint] NULL,
	[C014_ActMgrID] [smallint] NULL,
	[C017_UserGrpFlowID_From] [smallint] NULL,
	[C017_UserGrpFlowID_To] [smallint] NULL,
	[C017_UserGrpFlowFrom] [nvarchar](25) NULL,
	[C017_UserGrpFlowTo] [nvarchar](25) NULL,
	[C018_FlowTypeID] [smallint] NULL,
	[C018_KanbanPostID] [smallint] NULL,
	[C045_UserID] [int] NULL,
	[C045_UserName] [nvarchar](25) NULL,
	[C045_DTime] [datetime] NULL,
	[C045_UserNameUpdate] [nvarchar](25) NULL,
	[C045_DTimeLasUpdate] [datetime] NULL,
	[C050_DocNum] [nvarchar](25) NULL,
	[C050_DocDate] [smalldatetime] NULL,
	[C050_AccountDate] [smalldatetime] NULL,
	[C050_ExtDocNum] [nvarchar](50) NULL,
	[C050_ExtDocDate] [smalldatetime] NULL,
	[C050_ExtDocNum1] [nvarchar](25) NULL,
	[C050_ExtDocDate1] [smalldatetime] NULL,
	[C051_PONum] [nvarchar](30) NULL,
	[C051_FakturNum] [nvarchar](100) NULL,
	[C051_FakturDateTax] [smalldatetime] NULL,
	[C051_DueDate] [smalldatetime] NULL,
	[C052_TermOfPayment] [smallint] NULL,
	[C059_Remark] [nvarchar](1000) NULL,
	[C060_PartnerID] [smallint] NULL,
	[C061_PICName] [nvarchar](50) NULL,
	[C062_ActFixedAssetID] [int] NULL,
	[C070_CurrencyID] [smallint] NULL,
	[C071_Rate] [float] NULL,
	[C072_RateTax] [float] NULL,
	[C073_Amount] [float] NULL,
	[C073_AmountBruto] [float] NULL,
	[C074_AmountDiscount] [float] NULL,
	[C074_Expense] [float] NULL,
	[C075_AmountPpn] [float] NULL,
	[C075_AmountPph] [float] NULL,
	[C076_AmountFinal] [float] NULL,
	[C077_AmountBalance] [float] NULL,
	[C078_AmountPrepaid] [float] NULL,
	[C079_AmountGRNotInv] [float] NULL,
	[C080_PRCategoryID] [smallint] NULL,
	[C085_isPPN] [bit] NULL,
	[C090_EstDlvDate] [smalldatetime] NULL,
	[C113_PRType] [smallint] NULL,
	[SLedgerID] [smallint] NULL,
	[MLedgerID] [smallint] NULL,
	[SubLedger1ID] [smallint] NULL,
	[SubLedger2ID] [smallint] NULL,
	[PostCategoryID] [smallint] NULL,
	[Remark_PR] [nvarchar](1000) NULL,
	[YearIdx] [smallint] NULL,
	[DeptID] [smallint] NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T510_Proc]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T510_Proc](
	[C010_TrcTypeID] [int] NULL,
	[C011_Month] [smallint] NULL,
	[C012_TrcID] [int] NULL,
	[C050_Rev] [smallint] NULL,
	[C000_SysID] [int] NULL,
	[C000_LineSrc] [int] NULL,
	[C063_dtDelivery] [smalldatetime] NULL,
	[C100_ItemIntID] [int] NULL,
	[C100_ItemExtID] [int] NULL,
	[C100_ItemNameUser] [nvarchar](200) NULL,
	[C105_Note] [nvarchar](50) NULL,
	[C102_PriceInt] [float] NULL,
	[C110_Qty] [float] NULL,
	[C110_Qty2] [float] NULL,
	[C111_QtyBal] [float] NULL,
	[C125_AmountInt] [float] NULL,
	[C126_ValDiscount] [float] NULL,
	[C127_AmountDiscount] [float] NULL,
	[C130_MLedgerID] [smallint] NULL,
	[C131_SubLedger1ID] [smallint] NULL,
	[C132_SubLedger2ID] [smallint] NULL,
	[C135_Rate] [float] NULL,
	[C140_KategoryID] [smallint] NULL,
	[C150_UnitConvertion] [float] NULL,
	[C160_PRType] [smallint] NULL,
	[PostCategoryID] [smallint] NULL,
	[C128_NetAmount] [float] NULL,
	[CostCenterID] [smallint] NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T510_Temp]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T510_Temp](
	[C010_TrcTypeID] [int] NULL,
	[C011_Month] [smallint] NULL,
	[C012_TrcID] [int] NULL,
	[C050_Rev] [smallint] NULL,
	[C000_SysID] [int] NULL,
	[C000_LineSrc] [int] NULL,
	[C063_dtDelivery] [smalldatetime] NULL,
	[C100_ItemIntID] [int] NULL,
	[C100_ItemExtID] [int] NULL,
	[C100_ItemNameUser] [nvarchar](200) NULL,
	[C105_Note] [nvarchar](50) NULL,
	[C102_PriceInt] [float] NULL,
	[C110_Qty] [float] NULL,
	[C110_Qty2] [float] NULL,
	[C111_QtyBal] [float] NULL,
	[C125_AmountInt] [float] NULL,
	[C126_ValDiscount] [float] NULL,
	[C127_AmountDiscount] [float] NULL,
	[C130_MLedgerID] [smallint] NULL,
	[C131_SubLedger1ID] [smallint] NULL,
	[C132_SubLedger2ID] [smallint] NULL,
	[C135_Rate] [float] NULL,
	[C140_KategoryID] [smallint] NULL,
	[C150_UnitConvertion] [float] NULL,
	[C160_PRType] [smallint] NULL,
	[PostCategoryID] [smallint] NULL,
	[C128_NetAmount] [float] NULL,
	[CostCenterID] [smallint] NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T610_Trc]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T610_Trc](
	[C010_TrcTypeID] [smallint] NULL,
	[C011_Month] [smallint] NULL,
	[C012_TrcID] [smallint] NULL,
	[C050_Rev] [smallint] NULL,
	[C000_SysID] [smallint] NULL,
	[C014_MonthPostIdx] [int] NULL,
	[C013_MapperID] [smallint] NULL,
	[YearIdx] [smallint] NULL,
	[MonthIdx] [smallint] NULL,
	[C015_DatePost] [smalldatetime] NULL,
	[C016_TimePost] [datetime] NULL,
	[C045_UserName] [nvarchar](25) NULL,
	[C050_DocNum] [nvarchar](25) NULL,
	[C050_DocDate] [smalldatetime] NULL,
	[C050_AccountDate] [smalldatetime] NULL,
	[ActMgrObjTitle] [nvarchar](25) NULL,
	[Description] [nvarchar](370) NULL,
	[SLedgerID] [smallint] NULL DEFAULT ((0)),
	[MLedgerID] [smallint] NULL,
	[SubLedger1ID] [smallint] NULL DEFAULT ((0)),
	[SubLedger2ID] [smallint] NULL DEFAULT ((0)),
	[MinPlus] [smallint] NULL,
	[AmountTrc] [float] NULL DEFAULT ((0)),
	[AmountInTrc] [float] NULL DEFAULT ((0)),
	[AmountOutTrc] [float] NULL DEFAULT ((0)),
	[Currency] [nvarchar](5) NULL,
	[Rate] [float] NULL DEFAULT ((0)),
	[AmountLocal] [float] NULL DEFAULT ((0)),
	[AmountInLocal] [float] NULL DEFAULT ((0)),
	[AmountOutLocal] [float] NULL DEFAULT ((0)),
	[DocRef1] [nvarchar](100) NULL,
	[DocRef2] [nvarchar](100) NULL,
	[Description1] [nvarchar](150) NULL,
	[CostCenterID] [smallint] NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T640_Trc]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T640_Trc](
	[C010_TrcTypeID] [bigint] NULL,
	[C011_Month] [bigint] NULL,
	[C012_TrcID] [bigint] NULL,
	[C050_Rev] [bigint] NULL,
	[C000_SysID] [bigint] NULL,
	[C014_MonthPostIdx] [bigint] NULL,
	[C013_MapperID] [bigint] NULL,
	[YearIdx] [bigint] NULL,
	[MonthIdx] [bigint] NULL,
	[C015_DatePost] [smalldatetime] NULL,
	[C016_TimePost] [datetime] NULL,
	[C045_UserName] [nvarchar](25) NULL,
	[C050_DocNum] [nvarchar](25) NULL,
	[C050_DocDate] [smalldatetime] NULL,
	[ActMgrObjTitle] [nvarchar](25) NULL,
	[Description] [nvarchar](200) NULL,
	[FA_ActID] [bigint] NULL,
	[AmountTrc] [float] NULL,
	[Currency] [nvarchar](5) NULL,
	[Rate] [float] NULL,
	[AmountLocal] [float] NULL,
	[DocRef1] [nvarchar](50) NULL,
	[DocRef2] [nvarchar](50) NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[T680_Trc]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T680_Trc](
	[C010_TrcTypeID] [smallint] NULL,
	[C011_Month] [smallint] NULL,
	[C012_TrcID] [smallint] NULL,
	[C050_Rev] [smallint] NULL,
	[C000_SysID] [smallint] NULL,
	[YearIdx] [smallint] NULL,
	[MonthIdx] [smallint] NULL,
	[C015_DatePost] [smalldatetime] NULL,
	[C016_TimePost] [datetime] NULL,
	[C045_UserName] [nvarchar](25) NULL,
	[C050_DocNum] [nvarchar](25) NULL,
	[C050_DocDate] [smalldatetime] NULL,
	[ActMgrObjTitle] [nvarchar](25) NULL,
	[Description] [nvarchar](200) NULL,
	[CostCenterID] [smallint] NULL,
	[ItemGroupID] [smallint] NULL,
	[AmountTrc] [float] NULL
) ON [PRIMARY]

GO

/****** Object:  Table [dbo].[TD_Order]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[TD_Order](
	[RegID] [bigint] IDENTITY(1,1) NOT NULL,
	[TrcTypeID] [bigint] NULL,
	[MonthID] [bigint] NULL,
	[TrcID] [bigint] NULL,
	[LineID] [bigint] NULL,
	[DocDate] [date] NULL,
	[VendorID] [bigint] NULL,
	[RecievingArea] [varchar](15) NULL,
	[DeliveryDate] [date] NULL,
	[DeliveryTime] [time](0) NULL,
	[Classification] [varchar](15) NULL,
	[PONum] [varchar](50) NULL,
	[Item] [float] NULL,
	[ItemID] [bigint] NULL,
	[Qty] [float] NULL,
	[UserID] [bigint] NULL,
	[UserUpdateID] [bigint] NULL,
	[UpdateTime] [datetime] NULL,
	[RemarkD] [varchar](225) NULL,
	[IsDelete] [int] NULL DEFAULT ((0)),
	[Shift] [varchar](15) NULL,
	[Cycle] [int] NULL,
	[PartnerID] [bigint] NULL,
PRIMARY KEY CLUSTERED
(
	[RegID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[TD_Transaction]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[TD_Transaction](
	[RegID] [bigint] IDENTITY(1,1) NOT NULL,
	[TrcTypeID] [bigint] NULL,
	[MonthID] [bigint] NULL,
	[TrcID] [bigint] NULL,
	[LineID] [bigint] NULL,
	[ItemID] [bigint] NULL,
	[Qty_1] [float] NULL CONSTRAINT [DF__TD_Transa__Qty_1__47A6A41B]  DEFAULT ((0)),
	[Qty_2] [float] NULL CONSTRAINT [DF__TD_Transa__Qty_2__489AC854]  DEFAULT ((0)),
	[Qty_3] [float] NULL CONSTRAINT [DF__TD_Transa__Qty_3__498EEC8D]  DEFAULT ((0)),
	[Qty_4] [float] NULL CONSTRAINT [DF__TD_Transa__Qty_4__4A8310C6]  DEFAULT ((0)),
	[Qty_5] [float] NULL CONSTRAINT [DF__TD_Transa__Qty_5__4B7734FF]  DEFAULT ((0)),
	[Convertion_1] [float] NULL,
	[Convertion_2] [float] NULL,
	[TypeID] [bigint] NULL,
	[DetailDate] [date] NULL CONSTRAINT [DF__TD_Transa__Detai__4C6B5938]  DEFAULT (getdate()),
	[DetailTime] [time](0) NULL CONSTRAINT [DF__TD_Transa__Detai__4D5F7D71]  DEFAULT (CONVERT([time],getdate())),
	[AddressID] [bigint] NULL,
	[DetailDocNum] [varchar](25) NULL,
	[StartTime] [datetime] NULL,
	[EndTime] [datetime] NULL,
	[Duration] [float] NULL,
	[ProcessD] [bigint] NULL,
	[ProcessH] [bigint] NULL,
	[ProcessID] [bigint] NULL,
	[AddressDetail] [bigint] NULL,
	[RemarkD] [varchar](225) NULL,
	[LotNo] [bigint] NULL,
	[VanNo] [bigint] NULL,
	[Achievement] [float] NULL,
	[TotalDT] [float] NULL,
	[TotalPS] [float] NULL,
	[GSPH] [float] NULL,
	[CreateBy] [bigint] NULL,
	[PartnerID] [bigint] NULL,
	[SJNum] [varchar](50) NULL,
	[SJDate] [date] NULL,
	[ReffNum] [varchar](50) NULL,
	[MatNum] [varchar](50) NULL,
	[IsDelete] [bit] NULL CONSTRAINT [DF__TD_Transa__IsDel__4E53A1AA]  DEFAULT ((0)),
	[TrcTypeID_Ext] [bigint] NULL,
	[MonthID_Ext] [bigint] NULL,
	[TrcID_Ext] [bigint] NULL,
	[LineID_Ext] [bigint] NULL,
	[Price] [float] NULL,
	[Amount] [float] NULL,
	[BalAmount] [float] NULL,
	[OP1] [text] NULL,
	[OP2] [text] NULL,
	[PICName] [bigint] NULL,
 CONSTRAINT [TD_Transaction_pk] PRIMARY KEY CLUSTERED
(
	[RegID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[TD_Transaction_Delete]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[TD_Transaction_Delete](
	[RegID] [bigint] IDENTITY(1,1) NOT NULL,
	[TrcTypeID] [bigint] NULL,
	[MonthID] [bigint] NULL,
	[TrcID] [bigint] NULL,
	[LineID] [bigint] NULL,
	[ItemID] [bigint] NULL,
	[Qty_1] [float] NULL,
	[Qty_2] [float] NULL,
	[Qty_3] [float] NULL,
	[Qty_4] [float] NULL,
	[Qty_5] [float] NULL,
	[Convertion_1] [float] NULL,
	[Convertion_2] [float] NULL,
	[TypeID] [bigint] NULL,
	[DetailDate] [date] NULL,
	[DetailTime] [time](0) NULL,
	[AddressID] [bigint] NULL,
	[DetailDocNum] [varchar](25) NULL,
	[StartTime] [datetime] NULL,
	[EndTime] [datetime] NULL,
	[Duration] [float] NULL,
	[ProcessD] [bigint] NULL,
	[ProcessH] [bigint] NULL,
	[ProcessID] [bigint] NULL,
	[AddressDetail] [bigint] NULL,
	[RemarkD] [varchar](225) NULL,
	[LotNo] [bigint] NULL,
	[VanNo] [bigint] NULL,
	[Achievement] [float] NULL,
	[TotalDT] [float] NULL,
	[TotalPS] [float] NULL,
	[GSPH] [float] NULL,
	[CreateBy] [bigint] NULL,
	[PartnerID] [bigint] NULL,
	[SJNum] [varchar](50) NULL,
	[SJDate] [date] NULL,
	[ReffNum] [varchar](50) NULL,
	[MatNum] [varchar](50) NULL,
	[IsDelete] [bit] NULL,
	[TrcTypeID_Ext] [bigint] NULL,
	[MonthID_Ext] [bigint] NULL,
	[TrcID_Ext] [bigint] NULL,
	[LineID_Ext] [bigint] NULL,
	[Price] [float] NULL,
	[Amount] [float] NULL,
	[BalAmount] [float] NULL,
	[OP1] [text] NULL,
	[OP2] [text] NULL,
	[PICName] [bigint] NULL,
	[UpdateDate] [date] NULL,
	[UpdateTime] [time](0) NULL,
	[UpdateID] [bigint] NULL,
 CONSTRAINT [TD_Transaction_Delete_pk] PRIMARY KEY CLUSTERED
(
	[RegID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[TH_Order]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[TH_Order](
	[RegID] [bigint] IDENTITY(1,1) NOT NULL,
	[TrcTypeID] [bigint] NULL,
	[MonthID] [bigint] NULL,
	[TrcID] [bigint] NULL,
	[DocNum] [varchar](25) NULL,
	[DocDate] [date] NULL DEFAULT (getdate()),
	[DocTime] [time](0) NULL DEFAULT (CONVERT([time],getdate())),
	[UserID] [bigint] NULL,
	[UserUpdateID] [bigint] NULL,
	[UpdateTime] [datetime] NULL,
	[RemarkH] [varchar](225) NULL,
	[IsDelete] [int] NULL DEFAULT ((0)),
PRIMARY KEY CLUSTERED
(
	[RegID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

/****** Object:  Table [dbo].[TH_Transaction]    Script Date: 11/27/2017 3:48:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[TH_Transaction](
	[RegID] [bigint] IDENTITY(88,1) NOT NULL,
	[TrcTypeID] [bigint] NULL,
	[MonthID] [varchar](4) NULL,
	[TrcID] [bigint] NULL CONSTRAINT [DF__TH_Transa__TrcID__41EDCAC5] DEFAULT NULL,
	[DocNum] [varchar](25) NULL,
	[DocDate] [date] NULL CONSTRAINT [DF__TH_Transa__DocDa__42E1EEFE]  DEFAULT (getdate()),
	[DocTime] [time](0) NULL,
	[DocDate_Ext] [date] NULL,
	[UserID] [bigint] NULL,
	[PartnerID] [bigint] NULL,
	[PICName] [varchar](max) NULL,
	[DocNum_2] [varchar](25) NULL,
	[DocDate_2] [datetime] NULL CONSTRAINT [DF_TH_Transaction_DocDate_2]  DEFAULT (getdate()),
	[DocNum_3] [varchar](25) NULL,
	[DocDate_3] [datetime] NULL CONSTRAINT [DF_TH_Transaction_DocDate_3]  DEFAULT (getdate()),
	[ShiftID] [bigint] NULL,
	[CreateDate] [datetime] NULL CONSTRAINT [DF__TH_Transa__Creat__43D61337]  DEFAULT (getdate()),
	[LastUpdate] [datetime] NULL CONSTRAINT [DF__TH_Transa__LastU__44CA3770]  DEFAULT (getdate()),
	[UserUpdateID] [bigint] NULL,
	[LineID] [bigint] NULL,
	[FromAreaID] [bigint] NULL,
	[RemarkH] [varchar](225) NULL,
	[StatusID] [bigint] NULL,
	[OP1] [varchar](25) NULL,
	[OP2] [varchar](max) NULL,
 CONSTRAINT [TH_Transaction_pk] PRIMARY KEY CLUSTERED
(
	[RegID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[TD_Transaction_Delete] ADD  DEFAULT ((0)) FOR [Qty_1]
GO

ALTER TABLE [dbo].[TD_Transaction_Delete] ADD  DEFAULT ((0)) FOR [Qty_2]
GO

ALTER TABLE [dbo].[TD_Transaction_Delete] ADD  DEFAULT ((0)) FOR [Qty_3]
GO

ALTER TABLE [dbo].[TD_Transaction_Delete] ADD  DEFAULT ((0)) FOR [Qty_4]
GO

ALTER TABLE [dbo].[TD_Transaction_Delete] ADD  DEFAULT ((0)) FOR [Qty_5]
GO

ALTER TABLE [dbo].[TD_Transaction_Delete] ADD  DEFAULT (getdate()) FOR [DetailDate]
GO

ALTER TABLE [dbo].[TD_Transaction_Delete] ADD  DEFAULT (CONVERT([time],getdate())) FOR [DetailTime]
GO

ALTER TABLE [dbo].[TD_Transaction_Delete] ADD  DEFAULT ((0)) FOR [IsDelete]
GO

ALTER TABLE [dbo].[TD_Order]  WITH CHECK ADD  CONSTRAINT [TD_Order_fk_M_Product] FOREIGN KEY([ItemID])
REFERENCES [dbo].[M_Product] ([RegID])
GO

ALTER TABLE [dbo].[TD_Order] CHECK CONSTRAINT [TD_Order_fk_M_Product]
GO

ALTER TABLE [dbo].[TD_Order]  WITH CHECK ADD  CONSTRAINT [TD_Order_fk_M_Vendor] FOREIGN KEY([VendorID])
REFERENCES [dbo].[M_Vendor] ([RegID])
GO

ALTER TABLE [dbo].[TD_Order] CHECK CONSTRAINT [TD_Order_fk_M_Vendor]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'target / proses untuk monitoring' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TD_Transaction', @level2type=N'COLUMN',@level2name=N'TypeID'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'OrderReference / remark untuk suratjalan' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TD_Transaction', @level2type=N'COLUMN',@level2name=N'RemarkD'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'IDUnit untuk suratjalan' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TD_Transaction', @level2type=N'COLUMN',@level2name=N'LotNo'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Specs / Jobnumber untuk suratjalan' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TD_Transaction', @level2type=N'COLUMN',@level2name=N'ReffNum'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'OrderReference / remark untuk suratjalan' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TD_Transaction_Delete', @level2type=N'COLUMN',@level2name=N'RemarkD'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'IDUnit untuk suratjalan' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TD_Transaction_Delete', @level2type=N'COLUMN',@level2name=N'LotNo'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Specs / Jobnumber untuk suratjalan' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TD_Transaction_Delete', @level2type=N'COLUMN',@level2name=N'ReffNum'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'ReleaseDate untuk surat jalan ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TH_Transaction', @level2type=N'COLUMN',@level2name=N'DocDate_Ext'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'drivername & sectionhead untuk suratjalan' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TH_Transaction', @level2type=N'COLUMN',@level2name=N'PICName'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Revisi / DocNumDetail untuk suratjalan' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TH_Transaction', @level2type=N'COLUMN',@level2name=N'DocNum_2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'ShipDate & Shiptime untuk suratjalan' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TH_Transaction', @level2type=N'COLUMN',@level2name=N'DocDate_2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'carnum untuk suratjalan' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TH_Transaction', @level2type=N'COLUMN',@level2name=N'DocNum_3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'DlvAddress untuk suratjalan
utk monitoring:
1: assy
2: wip
3: spot gun
4: robot
5: lineA
6: lineBC
7: PCStock
8: QGate
9: Handwork
10: PressLine
11: RawMat' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TH_Transaction', @level2type=N'COLUMN',@level2name=N'FromAreaID'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'keterangan untuk confirm surat jalan' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TH_Transaction', @level2type=N'COLUMN',@level2name=N'OP2'
GO

