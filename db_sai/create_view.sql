USE [SAI_Work2]
GO

/****** Object:  View [dbo].[QM_UserG5]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[QM_UserG5]
AS
SELECT        dbo.M_UserG5.SysID, dbo.M_UserG5.RegID, dbo.M_UserG5.UserName, dbo.M_UserG5.FullName, dbo.M_UserG5.DeptID, dbo.M_UserG5.Password, dbo.M_UserG5.PasswordX, dbo.M_UserG5.Image, dbo.M_UserG5.Email,
                         dbo.M_Department.Dept_Name, dbo.M_UserG5.IsActive, dbo.M_UserG5.ActivationID, dbo.M_UserG5.Activation, dbo.M_UserG5.Area, dbo.M_Location.Location, dbo.M_Department.DeptSysID
FROM            dbo.M_UserG5 LEFT OUTER JOIN
                         dbo.M_Location ON dbo.M_UserG5.Area = dbo.M_Location.SysID LEFT OUTER JOIN
                         dbo.M_Department ON dbo.M_UserG5.DeptID = dbo.M_Department.id
WHERE        (dbo.M_UserG5.IsActive = 1)

GO

/****** Object:  View [dbo].[Q01_MProduct]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[Q01_MProduct]
AS
SELECT        dbo.M_Product.RegID, dbo.M_Product.PartNo, dbo.M_Product.PartName, dbo.M_Product.IDCust, dbo.M_Product.IDProject, dbo.M_Project.ProjectName, dbo.M_Category.code AS CodeCategory, dbo.M_Category.category_name,
                         dbo.M_Product.Spec1, dbo.M_Product.Spec2, { fn IFNULL(dbo.M_Product.PcsPerSheet, 0) } AS PcsPerSheet, { fn IFNULL(dbo.M_Product.PcsPerKg, 0) } AS PcsPerKg, dbo.M_Product.IDCategory, dbo.M_Product.IsMaterial,
                         dbo.M_Product.IsStamping, dbo.M_Product.IsWelding, dbo.M_Product.IsDelivery, dbo.M_Product.IsStoreRoom, dbo.M_Product.IsActive, dbo.M_Product.Price, dbo.M_Product.PcsPerday, dbo.M_Product.Min,
                         dbo.M_Product.Max, dbo.M_Product.DocDate, dbo.M_Product.UpdateBy, dbo.M_Product.MaterialType, { fn IFNULL(dbo.M_Product.StockFG, 0) } AS StockFG, dbo.M_Product.Image, dbo.M_Product.StockWip,
                         dbo.M_Product.IDUnit, dbo.M_Product.MasterBy AS IDMasterBy, dbo.M_Product.IsICT, dbo.M_Product.IsGA, dbo.M_Product.IsWIP, dbo.M_Product.StdPack, dbo.M_Product.IsSubcon, dbo.M_Partner.PartnerCode AS Code,
                         dbo.M_Partner.PartnerName AS CustName, dbo.M_Partner.Address, dbo.M_Product.IsDelete, M_Unit_1.code AS CodeUnit, M_Unit_1.unit, dbo.QM_UserG5.UserName, dbo.QM_UserG5.DeptID, dbo.M_Product.IDUnit_Buy,
                         dbo.M_Unit.code AS code_buy, dbo.M_Unit.unit AS unit_buy, dbo.M_Product.Convertion, dbo.M_Product.CurrencyID, dbo.M_Product.JobNum, dbo.M_Product.Description, dbo.M_Currency.Code AS Currency,
                         dbo.M_Currency.Desimal, dbo.M_Currency.TitikKoma, dbo.M_Product.IsG5, dbo.M_Product.PostCategoryID, dbo.T077_PostCategory.MLedgerID
FROM            dbo.M_Product LEFT OUTER JOIN
                         dbo.T077_PostCategory ON dbo.M_Product.PostCategoryID = dbo.T077_PostCategory.SysID LEFT OUTER JOIN
                         dbo.M_Currency ON dbo.M_Product.CurrencyID = dbo.M_Currency.SysID LEFT OUTER JOIN
                         dbo.M_Unit ON dbo.M_Product.IDUnit_Buy = dbo.M_Unit.id LEFT OUTER JOIN
                         dbo.QM_UserG5 ON dbo.M_Product.MasterBy = dbo.QM_UserG5.SysID LEFT OUTER JOIN
                         dbo.M_Partner ON dbo.M_Product.IDCust = dbo.M_Partner.SysID LEFT OUTER JOIN
                         dbo.M_Project ON dbo.M_Product.IDProject = dbo.M_Project.RegID LEFT OUTER JOIN
                         dbo.M_Unit AS M_Unit_1 ON dbo.M_Product.IDUnit = M_Unit_1.id LEFT OUTER JOIN
                         dbo.M_Category ON dbo.M_Product.IDCategory = dbo.M_Category.id
WHERE        (dbo.M_Product.IsDelete = N'X')

GO

/****** Object:  View [dbo].[QM_ChildPart_Conecting]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[QM_ChildPart_Conecting]
AS
SELECT        dbo.M_ChildPart_Conecting.SysID, dbo.M_ChildPart_Conecting.ItemID, dbo.M_ChildPart_Conecting.ChildPartID, dbo.Q01_MProduct.PartNo, dbo.Q01_MProduct.PartName, dbo.Q01_MProduct.ProjectName,
                         dbo.Q01_MProduct.Code
FROM            dbo.M_ChildPart_Conecting INNER JOIN
                         dbo.Q01_MProduct ON dbo.M_ChildPart_Conecting.ChildPartID = dbo.Q01_MProduct.RegID

GO

/****** Object:  View [dbo].[QTD_Transaction1]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[QTD_Transaction1]
AS
SELECT        TOP (100) PERCENT dbo.TD_Transaction.RegID, dbo.TD_Transaction.TrcTypeID, dbo.TD_Transaction.MonthID, dbo.TD_Transaction.TrcID, dbo.TD_Transaction.LineID, dbo.TD_Transaction.ItemID,
                         dbo.TD_Transaction.Qty_1, dbo.TD_Transaction.Qty_2, dbo.TD_Transaction.Qty_3, dbo.TD_Transaction.Qty_4, dbo.TD_Transaction.Qty_5, dbo.TD_Transaction.Convertion_1, dbo.TD_Transaction.Convertion_2,
                         dbo.TD_Transaction.TypeID, dbo.TD_Transaction.DetailDate, dbo.TD_Transaction.DetailTime, dbo.TD_Transaction.AddressID, dbo.TD_Transaction.DetailDocNum, dbo.TD_Transaction.StartTime,
                         dbo.TD_Transaction.EndTime, dbo.TD_Transaction.Duration, dbo.TD_Transaction.ProcessD, dbo.TD_Transaction.ProcessH, dbo.TD_Transaction.ProcessID, dbo.TD_Transaction.AddressDetail,
                         dbo.TD_Transaction.RemarkD, dbo.TD_Transaction.LotNo, dbo.TD_Transaction.VanNo, dbo.TD_Transaction.Achievement, dbo.TD_Transaction.TotalDT, dbo.TD_Transaction.TotalPS, dbo.TD_Transaction.GSPH,
                         dbo.TD_Transaction.CreateBy, dbo.TD_Transaction.SJNum, dbo.TD_Transaction.SJDate, dbo.TD_Transaction.ReffNum, dbo.TD_Transaction.MatNum, dbo.TD_Transaction.IsDelete, dbo.TH_Transaction.DocNum,
                         dbo.M_Product.PartNo, dbo.M_Product.PartName, dbo.M_Product.Spec1, dbo.M_Product.Spec2, dbo.M_Product.PcsPerSheet, dbo.M_Product.PcsPerKg, dbo.M_Product.IDCust, dbo.M_Product.IDProject,
                         dbo.M_Product.IDCategory, dbo.M_Department.Dept_Name, dbo.M_Category.code AS Category, dbo.M_Category.category_name, M_UserG5_1.UserName AS UserCreate, dbo.M_Project.ProjectName,
                         dbo.M_MaterialType.MaterialName, { fn IFNULL(dbo.M_Product.MaterialType, 1) } AS MaterialType, dbo.M_Product.StockWip, { fn IFNULL(dbo.M_Product.StockFG, 0) } AS StockFG, dbo.M_Product.IDUnit,
                         dbo.M_Unit.code AS CodeUnit, FLOOR(dbo.TD_Transaction.Qty_1 - dbo.TD_Transaction.Qty_3) AS CanEdit, dbo.TH_Transaction.DocDate, dbo.TH_Transaction.DocNum_2, dbo.TH_Transaction.PartnerID,
                         TD_Transaction_1.Qty_3 AS BalMatSource, TD_Transaction_1.Qty_4 AS BalPcsSource, TD_Transaction_1.TrcTypeID AS TrcTypeID_From, TD_Transaction_1.MonthID AS MonthID_From,
                         TD_Transaction_1.TrcID AS TrcID_From, TD_Transaction_1.LineID AS LineID_From, TD_Transaction_1.ItemID AS ItemIDExt, dbo.TH_Transaction.RemarkH, dbo.TH_Transaction.StatusID,
                         dbo.TH_Transaction.UserID, dbo.TH_Transaction.DocNum_3, dbo.TH_Transaction.DocDate_3, dbo.TH_Transaction.DocDate_2, dbo.Q01_MProduct.PartNo AS PartNo_From,
                         dbo.Q01_MProduct.PartName AS PartName_From, dbo.Q01_MProduct.Spec1 AS Spec1_From, dbo.Q01_MProduct.Spec2 AS Spec2_From, dbo.TD_Transaction.TrcTypeID_Ext, dbo.TD_Transaction.MonthID_Ext,
                         dbo.TD_Transaction.TrcID_Ext, dbo.TD_Transaction.LineID_Ext, dbo.TH_Transaction.DocDate_Ext, TD_Transaction_1.Convertion_1 AS Convertion_1_From,
                         TD_Transaction_1.Convertion_2 AS Convertion_2_From, dbo.TD_Transaction.Amount, dbo.TD_Transaction.BalAmount, dbo.TD_Transaction.Price, TD_Transaction_1.Amount AS AmountSource,
                         dbo.TD_Transaction.PartnerID AS PartnerIDDetail, M_Partner_1.PartnerCode AS PartnerCodeDetail, M_Partner_1.PartnerName AS PartnerNameDetail, M_Partner_1.Address AS PartnerAddressDetail,
                         TD_Transaction_1.BalAmount AS BalAmountSource, dbo.TD_Transaction.OP1, dbo.TD_Transaction.OP2, dbo.M_UserG5.FullName AS FullNameTR, dbo.M_UserG5.DeptID AS DeptIDTR,
                         dbo.TD_Transaction.PICName, M_Department_1.Dept_Name AS Dept_NameTR, M_Partner_2.PartnerCode, M_Partner_2.PartnerName, M_Partner_2.Address, dbo.M_Partner.PartnerCode AS Code,
                         dbo.M_Partner.PartnerName AS CustName
FROM            dbo.M_Partner RIGHT OUTER JOIN
                         dbo.M_Product INNER JOIN
                         dbo.TD_Transaction INNER JOIN
                         dbo.TH_Transaction ON dbo.TH_Transaction.TrcID = dbo.TD_Transaction.TrcID AND dbo.TH_Transaction.TrcTypeID = dbo.TD_Transaction.TrcTypeID AND
                         dbo.TH_Transaction.MonthID = dbo.TD_Transaction.MonthID ON dbo.M_Product.RegID = dbo.TD_Transaction.ItemID ON dbo.M_Partner.SysID = dbo.M_Product.IDCust LEFT OUTER JOIN
                         dbo.M_Partner AS M_Partner_2 ON dbo.TH_Transaction.PartnerID = M_Partner_2.SysID LEFT OUTER JOIN
                         dbo.M_Partner AS M_Partner_1 ON dbo.TD_Transaction.PartnerID = M_Partner_1.SysID RIGHT OUTER JOIN
                         dbo.M_UserG5 INNER JOIN
                         dbo.M_Department AS M_Department_1 ON dbo.M_UserG5.DeptID = M_Department_1.id ON dbo.TD_Transaction.PICName = dbo.M_UserG5.SysID LEFT OUTER JOIN
                         dbo.M_Department RIGHT OUTER JOIN
                         dbo.M_UserG5 AS M_UserG5_1 ON dbo.M_Department.id = M_UserG5_1.DeptID ON dbo.TH_Transaction.UserID = M_UserG5_1.SysID LEFT OUTER JOIN
                         dbo.TD_Transaction AS TD_Transaction_1 LEFT OUTER JOIN
                         dbo.Q01_MProduct ON TD_Transaction_1.ItemID = dbo.Q01_MProduct.RegID RIGHT OUTER JOIN
                         dbo.T_Connecting ON TD_Transaction_1.TrcTypeID = dbo.T_Connecting.TrcTypeID AND TD_Transaction_1.MonthID = dbo.T_Connecting.MonthID AND TD_Transaction_1.TrcID = dbo.T_Connecting.TrcID AND
                         TD_Transaction_1.LineID = dbo.T_Connecting.LineID ON dbo.TD_Transaction.TrcTypeID = dbo.T_Connecting.TrcTypeID_To AND dbo.TD_Transaction.MonthID = dbo.T_Connecting.MonthID_To AND
                         dbo.TD_Transaction.TrcID = dbo.T_Connecting.TrcID_To AND dbo.TD_Transaction.LineID = dbo.T_Connecting.LineID_To LEFT OUTER JOIN
                         dbo.M_Project ON dbo.M_Project.RegID = dbo.M_Product.IDProject LEFT OUTER JOIN
                         dbo.M_MaterialType ON dbo.M_MaterialType.RegID = dbo.M_Product.MaterialType LEFT OUTER JOIN
                         dbo.M_Unit ON dbo.M_Unit.id = dbo.M_Product.IDUnit LEFT OUTER JOIN
                         dbo.M_Category ON dbo.M_Product.IDCategory = dbo.M_Category.id
WHERE        (dbo.TD_Transaction.IsDelete <> 1)
ORDER BY dbo.TD_Transaction.RegID DESC

GO

/****** Object:  View [dbo].[QM_UserRole]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[QM_UserRole]
AS
SELECT        dbo.QM_UserG5.SysID, dbo.M_UserRole.NumOf, dbo.QM_UserG5.RegID, dbo.QM_UserG5.UserName, dbo.M_UserRole.ActivityID, dbo.T_30_ActMgr.ObjTitle, dbo.T_30_ActMgr.CodeName, dbo.M_UserRole.DelData,
                         dbo.M_UserRole.UpData, dbo.M_UserRole.RetData, dbo.M_UserRole.ViewJurnal, dbo.M_UserRole.UserGroupFlow AS UserGroupFlowID, dbo.T_30_UserGrpFlow.Descr AS UserGroupFlow, dbo.M_UserRole.UserID
FROM            dbo.QM_UserG5 INNER JOIN
                         dbo.M_UserRole ON dbo.QM_UserG5.SysID = dbo.M_UserRole.UserID LEFT OUTER JOIN
                         dbo.T_30_UserGrpFlow ON dbo.M_UserRole.UserGroupFlow = dbo.T_30_UserGrpFlow.SysID LEFT OUTER JOIN
                         dbo.T_30_ActMgr ON dbo.M_UserRole.ActivityID = dbo.T_30_ActMgr.SysID

GO

/****** Object:  View [dbo].[QTD_Transaction]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[QTD_Transaction]
AS
SELECT        dbo.TD_Transaction.RegID, dbo.TD_Transaction.TrcTypeID, dbo.TD_Transaction.MonthID, dbo.TD_Transaction.TrcID, dbo.TD_Transaction.LineID, dbo.TD_Transaction.ItemID, dbo.TD_Transaction.Qty_1,
                         dbo.TD_Transaction.Qty_2, dbo.TD_Transaction.Qty_3, dbo.TD_Transaction.Qty_4, dbo.TD_Transaction.Qty_5, dbo.TD_Transaction.Convertion_1, dbo.TD_Transaction.Convertion_2, dbo.TD_Transaction.TypeID,
                         dbo.TD_Transaction.DetailDate, dbo.TD_Transaction.DetailTime, dbo.TD_Transaction.AddressID, dbo.TD_Transaction.DetailDocNum, dbo.TD_Transaction.StartTime, dbo.TD_Transaction.EndTime,
                         dbo.TD_Transaction.Duration, dbo.TD_Transaction.ProcessD, dbo.TD_Transaction.ProcessH, dbo.TD_Transaction.AddressDetail, dbo.TD_Transaction.RemarkD, dbo.TD_Transaction.LotNo,
                         dbo.TD_Transaction.VanNo, dbo.TD_Transaction.Achievement, dbo.TD_Transaction.TotalDT, dbo.TD_Transaction.TotalPS, dbo.TD_Transaction.GSPH, dbo.TD_Transaction.CreateBy, dbo.TD_Transaction.SJNum,
                         dbo.TD_Transaction.SJDate, dbo.TD_Transaction.ReffNum, dbo.TD_Transaction.MatNum, dbo.Q01_MProduct.PartNo, dbo.Q01_MProduct.PartName, dbo.Q01_MProduct.Spec1, dbo.Q01_MProduct.Spec2,
                         dbo.Q01_MProduct.PcsPerSheet, dbo.Q01_MProduct.PcsPerKg, dbo.Q01_MProduct.IDCust, dbo.Q01_MProduct.IDProject, dbo.Q01_MProduct.IDCategory, dbo.QM_UserG5.Dept_Name,
                         dbo.Q01_MProduct.CodeCategory AS Category, dbo.Q01_MProduct.category_name, dbo.QM_UserG5.UserName AS UserCreate, dbo.Q01_MProduct.ProjectName,
                         dbo.Q01_MProduct.MaterialType, dbo.Q01_MProduct.StockWip, dbo.Q01_MProduct.StockFG, dbo.Q01_MProduct.IDUnit, dbo.Q01_MProduct.CodeUnit,
                         FLOOR(dbo.TD_Transaction.Qty_1 - dbo.TD_Transaction.Qty_3) AS CanEdit, dbo.TH_Transaction.DocDate, dbo.TH_Transaction.DocNum_2, dbo.TH_Transaction.PartnerID,
                         TD_Transaction_1.Qty_3 AS BalMatSource, TD_Transaction_1.Qty_4 AS BalPcsSource, TD_Transaction_1.TrcTypeID AS TrcTypeID_From, TD_Transaction_1.MonthID AS MonthID_From,
                         TD_Transaction_1.TrcID AS TrcID_From, TD_Transaction_1.LineID AS LineID_From, TD_Transaction_1.ItemID AS ItemIDExt, dbo.TH_Transaction.RemarkH, dbo.TH_Transaction.StatusID,
                         dbo.TH_Transaction.UserID, dbo.TH_Transaction.DocNum_3, dbo.TH_Transaction.DocDate_3, dbo.TH_Transaction.DocDate_2, Q01_MProduct_1.PartNo AS PartNo_From,
                         Q01_MProduct_1.PartName AS PartName_From, Q01_MProduct_1.Spec1 AS Spec1_From, Q01_MProduct_1.Spec2 AS Spec2_From, dbo.TD_Transaction.TrcTypeID_Ext, dbo.TD_Transaction.MonthID_Ext,
                         dbo.TD_Transaction.TrcID_Ext, dbo.TD_Transaction.LineID_Ext, dbo.TH_Transaction.DocDate_Ext, TD_Transaction_1.Convertion_1 AS Convertion_1_From,
                         TD_Transaction_1.Convertion_2 AS Convertion_2_From, dbo.TD_Transaction.Amount, dbo.TD_Transaction.BalAmount, dbo.TD_Transaction.Price, TD_Transaction_1.Amount AS AmountSource,
                         dbo.TD_Transaction.PartnerID AS PartnerIDDetail, dbo.M_Partner.PartnerCode AS PartnerCodeDetail, dbo.M_Partner.PartnerName AS PartnerNameDetail, dbo.M_Partner.Address AS PartnerAddressDetail,
                         TD_Transaction_1.BalAmount AS BalAmountSource, dbo.TD_Transaction.OP1, dbo.TD_Transaction.OP2, QM_UserG5_1.FullName AS FullNameTR, QM_UserG5_1.DeptID AS DeptIDTR,
                         dbo.TD_Transaction.PICName, QM_UserG5_1.Dept_Name AS Dept_NameTR, dbo.Q01_MProduct.Code, dbo.Q01_MProduct.CustName, dbo.TH_Transaction.DocNum, dbo.TH_Transaction.DocTime,
                         dbo.TH_Transaction.PICName AS PICNameID_Detail, dbo.TH_Transaction.ShiftID, dbo.TH_Transaction.CreateDate, dbo.TH_Transaction.LastUpdate, dbo.Q01_MProduct.unit, M_Partner_1.PartnerCode,
                         M_Partner_1.PartnerName, M_Partner_1.Address, dbo.TD_Transaction.IsDelete
FROM            dbo.Q01_MProduct AS Q01_MProduct_1 INNER JOIN
                         dbo.TD_Transaction AS TD_Transaction_1 ON Q01_MProduct_1.RegID = TD_Transaction_1.ItemID RIGHT OUTER JOIN
                         dbo.T_Connecting RIGHT OUTER JOIN
                         dbo.TD_Transaction INNER JOIN
                         dbo.TH_Transaction ON dbo.TD_Transaction.TrcTypeID = dbo.TH_Transaction.TrcTypeID AND dbo.TD_Transaction.MonthID = dbo.TH_Transaction.MonthID AND
                         dbo.TD_Transaction.TrcID = dbo.TH_Transaction.TrcID LEFT OUTER JOIN
                         dbo.M_Partner AS M_Partner_1 ON dbo.TH_Transaction.PartnerID = M_Partner_1.SysID LEFT OUTER JOIN
                         dbo.M_Partner ON dbo.TD_Transaction.PartnerID = dbo.M_Partner.SysID ON dbo.T_Connecting.TrcTypeID_To = dbo.TD_Transaction.TrcTypeID AND
                         dbo.T_Connecting.MonthID_To = dbo.TD_Transaction.MonthID AND dbo.T_Connecting.TrcID_To = dbo.TD_Transaction.TrcID AND dbo.T_Connecting.LineID_To = dbo.TD_Transaction.LineID ON
                         TD_Transaction_1.TrcTypeID = dbo.T_Connecting.TrcTypeID AND TD_Transaction_1.MonthID = dbo.T_Connecting.MonthID AND TD_Transaction_1.TrcID = dbo.T_Connecting.TrcID AND
                         TD_Transaction_1.LineID = dbo.T_Connecting.LineID LEFT OUTER JOIN
                         dbo.QM_UserG5 AS QM_UserG5_1 ON dbo.TD_Transaction.PICName = QM_UserG5_1.SysID LEFT OUTER JOIN
                         dbo.QM_UserG5 ON dbo.TH_Transaction.UserID = dbo.QM_UserG5.SysID LEFT OUTER JOIN
                         dbo.Q01_MProduct ON dbo.TD_Transaction.ItemID = dbo.Q01_MProduct.RegID
WHERE        (dbo.TD_Transaction.IsDelete = 0)

GO

/****** Object:  View [dbo].[SCMaterial_IN]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCMaterial_IN]
AS
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, Qty_1 AS INMat, { fn IFNULL(Qty_5, 0) } AS OUTMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg,
                         DetailTime AS DocTime, Qty_3 AS BalMat, Qty_4 AS BalPcs, RegID, TrcTypeID, MonthID, TrcID, LineID
FROM            dbo.QTD_Transaction
WHERE        (TrcTypeID = 110 OR
                         TrcTypeID = 125 OR
                         TrcTypeID = 300)
ORDER BY DocDate

GO

/****** Object:  View [dbo].[RMStock]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[RMStock]
AS
SELECT        dbo.M_Product.RegID AS ItemID, dbo.M_Product.PartNo, dbo.M_Product.PartName, dbo.M_Product.Spec1, dbo.M_Product.Spec2, dbo.M_Product.PcsPerSheet, dbo.M_Product.PcsPerKg, dbo.M_Product.IDCust,
                         dbo.M_Product.IDProject, dbo.M_Product.IDCategory, dbo.M_Product.IsMaterial, dbo.M_Product.IsStoreRoom, dbo.M_Product.IsActive, dbo.M_Product.Price, dbo.M_Product.PcsPerday, dbo.M_Product.Min,
                         dbo.M_Product.Max, { fn IFNULL(SUM(dbo.SCMaterial_IN.BalMat), 0) } AS BalMat, { fn IFNULL(SUM(dbo.SCMaterial_IN.BalPcs), 0) } AS BalPcs, dbo.M_Partner.PartnerCode AS Code,
                         dbo.M_Partner.PartnerName AS CustName, dbo.M_Product.IsDelete
FROM            dbo.M_Product LEFT OUTER JOIN
                         dbo.M_Partner ON dbo.M_Product.IDCust = dbo.M_Partner.SysID LEFT OUTER JOIN
                         dbo.SCMaterial_IN ON dbo.M_Product.RegID = dbo.SCMaterial_IN.ItemID
GROUP BY dbo.M_Product.RegID, dbo.M_Product.PartNo, dbo.M_Product.PartName, dbo.M_Product.Spec1, dbo.M_Product.Spec2, dbo.M_Product.PcsPerSheet, dbo.M_Product.PcsPerKg, dbo.M_Product.IDCust,
                         dbo.M_Product.IDProject, dbo.M_Product.IDCategory, dbo.M_Product.IsMaterial, dbo.M_Product.IsStoreRoom, dbo.M_Product.IsActive, dbo.M_Product.Price, dbo.M_Product.PcsPerday, dbo.M_Product.Min,
                         dbo.M_Product.Max, dbo.M_Partner.PartnerCode, dbo.M_Partner.PartnerName, dbo.M_Product.IsDelete
HAVING        (dbo.M_Product.IsActive = 1) AND (dbo.M_Product.IsMaterial = 1) AND (dbo.M_Product.IsDelete = 'X')

GO

/****** Object:  View [dbo].[MonitoringRM_Ext]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

create view [dbo].[MonitoringRM_Ext] AS
SELECT        dbo.RMStock.ItemID, dbo.RMStock.PartNo, dbo.RMStock.PartName, dbo.RMStock.Spec1, dbo.RMStock.Spec2, dbo.RMStock.PcsPerSheet, dbo.RMStock.PcsPerKg, dbo.RMStock.IDCust, dbo.RMStock.IDProject,
                         dbo.RMStock.IsMaterial, dbo.RMStock.IsActive, dbo.RMStock.PcsPerday, dbo.RMStock.Min, dbo.RMStock.Max, dbo.RMStock.Code, dbo.RMStock.CustName, dbo.M_Product.MaterialType, dbo.RMStock.BalMat,
                         IIF(dbo.M_Product.MaterialType = 1, dbo.RMStock.BalMat / dbo.RMStock.PcsPerKg, dbo.RMStock.BalMat * dbo.RMStock.PcsPerSheet) AS BalPcs
FROM            dbo.RMStock LEFT OUTER JOIN
                         dbo.M_Product ON dbo.RMStock.ItemID = dbo.M_Product.RegID
GO

/****** Object:  View [dbo].[MonitoringRM]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

create view [dbo].[MonitoringRM] AS
SELECT        ItemID, PartNo, PartName, Spec1, Spec2, PcsPerSheet, PcsPerKg, IDCust, IDProject, IsMaterial, IsActive, PcsPerday, Min, Max, Code, CustName, BalMat, BalPcs, COALESCE (BalPcs / NULLIF (PcsPerday, 0), 0)
                         AS hari, MaterialType
FROM            dbo.MonitoringRM_Ext
GO

/****** Object:  View [dbo].[MonitoringRMListCust]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

create view [dbo].[MonitoringRMListCust] AS
SELECT        ROW_NUMBER() OVER (ORDER BY dbo.M_Customer.Code ASC) AS NOMOR, dbo.M_Customer.RegID, dbo.M_Customer.Code, dbo.M_Customer.CustName
FROM            dbo.MonitoringRM INNER JOIN
                         dbo.M_Customer ON dbo.MonitoringRM.IDCust = dbo.M_Customer.RegID
GROUP BY dbo.M_Customer.RegID, dbo.M_Customer.Code, dbo.M_Customer.CustName
GO

/****** Object:  View [dbo].[SCWareHouse_IN]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCWareHouse_IN]
AS
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, Qty_1 AS INMat, { fn IFNULL(Qty_5, 0) } AS OUTMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg,
                         DetailTime AS DocTime, Qty_3 AS BalMat, Qty_4 AS BalPcs, RegID, TrcTypeID, MonthID, TrcID, LineID
FROM            dbo.QTD_Transaction
WHERE        (TrcTypeID = 1500)
ORDER BY DocDate

GO

/****** Object:  View [dbo].[SCWareHouse_OUT]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCWareHouse_OUT]
AS
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, Qty_1 AS OUTMat, { fn IFNULL(Qty_5, 0) } AS INMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg,
                         DetailTime AS DocTime, Qty_3 AS BalMat, Qty_4 AS BalPcs, RegID, TrcTypeID, MonthID, TrcID, LineID
FROM            dbo.QTD_Transaction
WHERE        (TrcTypeID = 1600)
ORDER BY DocDate

GO

/****** Object:  View [dbo].[SCWareHouse_Ext]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCWareHouse_Ext]
AS
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, INMat, OUTMat, IDCust, Code, CustName, DocTime, RegID, TrcTypeID, MonthID, TrcID, LineID
FROM            dbo.SCWareHouse_IN
UNION
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, INMat, OUTMat, IDCust, Code, CustName, DocTime, RegID, TrcTypeID, MonthID, TrcID, LineID
FROM            dbo.SCWareHouse_OUT

GO

/****** Object:  View [dbo].[SCWareHouse]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCWareHouse]
AS
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, DocTime, ItemID, PartNo, PartName, INMat, OUTMat, IDCust, Code, CustName, TrcTypeID, MonthID, TrcID, LineID
FROM            dbo.SCWareHouse_Ext
ORDER BY DocDate, DocTime

GO

/****** Object:  View [dbo].[WareHouseStock_Ext]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[WareHouseStock_Ext]
AS
SELECT        dbo.M_Product.RegID AS ItemID, dbo.M_Product.PartNo, dbo.M_Product.PartName, { fn IFNULL(SUM(dbo.SCWareHouse.INMat), 0) } AS [IN], { fn IFNULL(SUM(dbo.SCWareHouse.OUTMat), 0) } AS OUT,
                         dbo.M_Product.PcsPerday, { fn IFNULL(dbo.M_Product.StockFG, 0) } AS StockFG, dbo.M_Product.IsActive, dbo.M_DetailStatus.Detail AS DetailStatus, dbo.M_Product.StdPack, dbo.M_Project.ProjectName,
                         dbo.M_Product.IDCust, dbo.M_Partner.PartnerCode AS Code, dbo.M_Partner.PartnerName AS CustName
FROM            dbo.M_DetailStatus INNER JOIN
                         dbo.M_Product ON dbo.M_DetailStatus.RegID = dbo.M_Product.IsActive LEFT OUTER JOIN
                         dbo.M_Partner ON dbo.M_Product.IDCust = dbo.M_Partner.SysID LEFT OUTER JOIN
                         dbo.M_Project ON dbo.M_Product.IDProject = dbo.M_Project.RegID LEFT OUTER JOIN
                         dbo.SCWareHouse ON dbo.M_Product.RegID = dbo.SCWareHouse.ItemID
WHERE        (dbo.M_Product.IsActive = 1) AND (dbo.M_Product.IsDelivery = 1)
GROUP BY dbo.M_Product.RegID, dbo.M_Product.PartNo, dbo.M_Product.PartName, dbo.M_Product.PcsPerday, dbo.M_Product.StockFG, dbo.M_Product.IsActive, dbo.M_DetailStatus.Detail, dbo.M_Product.StdPack,
                         dbo.M_Project.ProjectName, dbo.M_Product.IDCust, dbo.M_Partner.PartnerCode, dbo.M_Partner.PartnerName

GO

/****** Object:  View [dbo].[WareHouseStock]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[WareHouseStock]
AS
SELECT        TOP (100) PERCENT ItemID, PartNo, PartName, IDCust, Code, [IN], OUT, [IN] - OUT + StockFG AS Stock, PcsPerday, StockFG, IsActive, DetailStatus, StdPack, ProjectName
FROM            dbo.WareHouseStock_Ext
GROUP BY ItemID, PartNo, PartName, IDCust, [IN], OUT, Code, [IN] - OUT + StockFG, PcsPerday, StockFG, IsActive, DetailStatus, StdPack, ProjectName
ORDER BY Code

GO

/****** Object:  View [dbo].[MonitoringFG]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[MonitoringFG]
AS
SELECT        ItemID, PartNo, PartName, IDCust, Code, [IN], OUT, Stock, PcsPerday, StockFG, IsActive, DetailStatus, StdPack, COALESCE (StockFG / NULLIF (PcsPerday, 0), 0) AS hari
FROM            dbo.WareHouseStock

GO

/****** Object:  View [dbo].[MonitoringFGListCust]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[MonitoringFGListCust]
AS
SELECT        ROW_NUMBER() OVER (ORDER BY dbo.M_Customer.Code ASC) AS NOMOR, dbo.M_Customer.RegID, dbo.M_Customer.Code, dbo.M_Customer.CustName
FROM            dbo.MonitoringFG INNER JOIN
                         dbo.M_Customer ON dbo.MonitoringFG.IDCust = dbo.M_Customer.RegID
GROUP BY dbo.M_Customer.RegID, dbo.M_Customer.Code, dbo.M_Customer.CustName

GO

/****** Object:  View [dbo].[SCMaterial_OUT]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCMaterial_OUT]
AS
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, Qty_1 AS OUTMat, { fn IFNULL(Qty_5, 0) } AS INMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg,
                         DetailTime AS DocTime, Qty_3 AS BalMat, Qty_4 AS BalPcs, RegID, TrcTypeID, MonthID, TrcID, LineID
FROM            dbo.QTD_Transaction
WHERE        (TrcTypeID = 200) OR
                         (TrcTypeID = 210) OR
                         (TrcTypeID = 215) OR
                         (TrcTypeID = 220) OR
                         (TrcTypeID = 225)
ORDER BY DocDate

GO

/****** Object:  View [dbo].[Master_BOM]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[Master_BOM]
AS
SELECT        TOP (100) PERCENT dbo.BOM1.SysID, dbo.BOM2.SysID AS SysID2, dbo.BOM2.NoUrut, dbo.BOM1.IDCust, dbo.BOM1.IDProject, dbo.BOM2.PartNo, dbo.BOM2.PartName, dbo.M_Customer.CustName,
                         dbo.BOM1.CreateBy, dbo.BOM2.LevelPart, dbo.BOM2.PartType AS PartTypeID, dbo.BOM2.QtyPerCar, dbo.BOM2.SupplierID, dbo.BOM2.Spec, dbo.BOM2.Thick, dbo.BOM2.Width, dbo.BOM2.Length,
                         dbo.BOM2.PcsPerSheet, dbo.BOM2.KgPerSheet, dbo.BOM2.PartWeight, dbo.BOM2.MaterialType AS MaterialTypeID, dbo.BOM3.OP5M, dbo.BOM3.OP10M, dbo.BOM3.OP20M, dbo.BOM3.OP30M,
                         dbo.BOM3.OP40M, dbo.BOM3.OP50M, dbo.BOM3.OP60M, dbo.BOM3.OP70M, dbo.BOM4.OP5, dbo.BOM4.OP10, dbo.BOM4.OP20, dbo.BOM4.OP30, dbo.BOM4.OP40, dbo.BOM4.OP50, dbo.BOM4.OP60,
                         dbo.BOM4.OP70, dbo.BOM5.ProcessAssy, dbo.BOM5.LineAssy, dbo.M_MaterialType.MaterialName AS MaterialType, dbo.M_Project.ProjectName, dbo.BOM6.PartType, dbo.M_Partner.PartnerName,
                         dbo.BOM2.FGLocation, dbo.BOM2.StdPack, dbo.BOM2.PackingType, dbo.BOM2.ItemNo, dbo.BOM2.ItemNoSub, dbo.BOM1.IsDelete, dbo.BOM1.IsActive, dbo.BOM2.IsActiveDetail, dbo.BOM2.IsDeleteDetail,
                         dbo.M_Customer.Code, dbo.BOM2.PcsPerDay, dbo.BOM2.LinkID, dbo.BOM2.SpecOrder1, dbo.BOM2.SpecOrder2, dbo.BOM2.IsCommon, dbo.BOM2.QtyPart, dbo.BOM2.Ratio, dbo.BOM2.PartNo_Ext,
                         dbo.BOM2.PartName_Ext, dbo.BOM2.IsCommonGroup, dbo.BOM2.GroupCommonID
FROM            dbo.BOM4 RIGHT OUTER JOIN
                         dbo.BOM5 RIGHT OUTER JOIN
                         dbo.M_MaterialType RIGHT OUTER JOIN
                         dbo.BOM6 RIGHT OUTER JOIN
                         dbo.BOM2 LEFT OUTER JOIN
                         dbo.M_Partner ON dbo.M_Partner.SysID = dbo.BOM2.SupplierID ON dbo.BOM6.SysID = dbo.BOM2.PartType ON dbo.M_MaterialType.RegID = dbo.BOM2.MaterialType ON dbo.BOM5.SysID = dbo.BOM2.SysID ON
                         dbo.BOM4.SysID = dbo.BOM2.SysID LEFT OUTER JOIN
                         dbo.BOM3 ON dbo.BOM2.SysID = dbo.BOM3.SysID LEFT OUTER JOIN
                         dbo.M_Project RIGHT OUTER JOIN
                         dbo.BOM1 ON dbo.M_Project.RegID = dbo.BOM1.IDProject ON dbo.BOM2.LinkID = dbo.BOM1.SysID LEFT OUTER JOIN
                         dbo.M_Customer ON dbo.BOM1.IDCust = dbo.M_Customer.RegID
WHERE        (dbo.BOM1.IsDelete = 0) AND (dbo.BOM2.IsDeleteDetail = 0)
ORDER BY dbo.BOM1.SysID, dbo.BOM2.NoUrut, dbo.BOM2.ItemNoSub

GO

/****** Object:  View [dbo].[QCMProduct_BOM]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[QCMProduct_BOM]
AS
SELECT        dbo.CMProduct_BOM.SysID, dbo.CMProduct_BOM.ItemID_Product, dbo.CMProduct_BOM.ItemID_BOM, dbo.Master_BOM.SysID2, dbo.Master_BOM.PartNo, dbo.Master_BOM.PartName, dbo.Master_BOM.IDCust,
                         dbo.Master_BOM.IDProject, dbo.Master_BOM.CustName, dbo.Master_BOM.PartTypeID, dbo.Master_BOM.ProjectName, dbo.Master_BOM.Code, dbo.Master_BOM.LinkID
FROM            dbo.CMProduct_BOM INNER JOIN
                         dbo.Master_BOM ON dbo.CMProduct_BOM.ItemID_BOM = dbo.Master_BOM.SysID2
GO

/****** Object:  View [dbo].[QRM_DetailTrc]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[QRM_DetailTrc]
AS
SELECT        dbo.QCMProduct_BOM.SysID, dbo.QCMProduct_BOM.ItemID_BOM, dbo.QTD_Transaction.DetailDocNum, dbo.QTD_Transaction.DocDate, dbo.QTD_Transaction.DetailDate AS CreateDate,
                         dbo.QTD_Transaction.DetailTime AS DocTime, dbo.QTD_Transaction.Qty_1, dbo.QTD_Transaction.ItemID, dbo.QTD_Transaction.PartNo, dbo.QTD_Transaction.PartName, dbo.QTD_Transaction.Spec1,
                         dbo.QTD_Transaction.Spec2, dbo.QTD_Transaction.IDCust, dbo.QTD_Transaction.CustName, dbo.QTD_Transaction.MaterialType, dbo.QTD_Transaction.SJNum, dbo.QTD_Transaction.SJDate,
                         dbo.QCMProduct_BOM.ItemID_Product, dbo.QTD_Transaction.DocNum, dbo.QTD_Transaction.Code, dbo.QTD_Transaction.CreateBy, dbo.QTD_Transaction.TrcTypeID, dbo.QTD_Transaction.ProjectName,
                         dbo.QCMProduct_BOM.LinkID
FROM            dbo.QCMProduct_BOM INNER JOIN
                         dbo.QTD_Transaction ON dbo.QCMProduct_BOM.ItemID_Product = dbo.QTD_Transaction.ItemID

GO

/****** Object:  View [dbo].[QProduction_DetailTrc]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[QProduction_DetailTrc]
AS
SELECT        dbo.QCMProduct_BOM.SysID, dbo.QCMProduct_BOM.ItemID_BOM, dbo.QCMProduct_BOM.ItemID_Product, dbo.QTD_Transaction.DocNum, dbo.QTD_Transaction.DetailDocNum as DocNumDetail, dbo.QTD_Transaction.ItemID,
                         dbo.QTD_Transaction.Qty_1 as Qty, dbo.QTD_Transaction.Qty_4 as NG, dbo.QTD_Transaction.ProcessD as ProsesD, dbo.QTD_Transaction.ProcessH as ProsesH, dbo.QTD_Transaction.DocDate,
                         dbo.QTD_Transaction.DetailDate as CreateDate, dbo.QTD_Transaction.DetailTime as CreateTime, dbo.QTD_Transaction.PartNo, dbo.QTD_Transaction.PartName,
                         dbo.QTD_Transaction.CustName, dbo.QTD_Transaction.RemarkD as Remark, dbo.QTD_Transaction.StatusID as Status, dbo.QTD_Transaction.IDProject,
                         dbo.QTD_Transaction.ProjectName, dbo.QTD_Transaction.Code as Customer,
                         dbo.QTD_Transaction.Duration as Durasi,
                         dbo.QTD_Transaction.LotNo, dbo.QTD_Transaction.VanNo, dbo.QTD_Transaction.IsDelete, dbo.QTD_Transaction.CreateBy, dbo.QCMProduct_BOM.SysID2, dbo.QCMProduct_BOM.LinkID
FROM            dbo.QCMProduct_BOM INNER JOIN
                         dbo.QTD_Transaction ON dbo.QCMProduct_BOM.ItemID_Product = dbo.QTD_Transaction.ItemID
GO

/****** Object:  View [dbo].[Q094_CostCenterDetail_Sum]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[Q094_CostCenterDetail_Sum]
AS
SELECT        CostCenterID, SUM(Nominal) AS SumAmount
FROM            dbo.T094_CostCenterDetail
GROUP BY CostCenterID

GO

/****** Object:  View [dbo].[Q680_SummaryBudget]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[Q680_SummaryBudget]
AS
SELECT        YearIdx, CostCenterID AS DeptID, SUM(AmountTrc) AS Amount
FROM            dbo.T680_Trc
GROUP BY YearIdx, CostCenterID

GO

/****** Object:  View [dbo].[Q093_CostCenter]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[Q093_CostCenter]
AS
SELECT        dbo.T093_CostCenter.SysID, dbo.T093_CostCenter.YearIdx, dbo.T093_CostCenter.DeptID, dbo.T093_CostCenter.Budget, ISNULL(dbo.Q094_CostCenterDetail_Sum.SumAmount, 0) AS SumDetail,
                         ISNULL(dbo.Q680_SummaryBudget.Amount, 0) AS AmountUsage, dbo.T093_CostCenter.Budget - ISNULL(dbo.Q680_SummaryBudget.Amount, 0) AS AmountAvail, 2 AS Decimal, 1 AS TitikKoma,
                         dbo.T015_Department.Department
FROM            dbo.T093_CostCenter LEFT OUTER JOIN
                         dbo.T015_Department ON dbo.T093_CostCenter.DeptID = dbo.T015_Department.SysID LEFT OUTER JOIN
                         dbo.Q094_CostCenterDetail_Sum ON dbo.T093_CostCenter.SysID = dbo.Q094_CostCenterDetail_Sum.CostCenterID LEFT OUTER JOIN
                         dbo.Q680_SummaryBudget ON dbo.T093_CostCenter.DeptID = dbo.Q680_SummaryBudget.DeptID AND dbo.T093_CostCenter.YearIdx = dbo.Q680_SummaryBudget.YearIdx

GO

/****** Object:  View [dbo].[SCToolRoom_IN]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCToolRoom_IN]
AS
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, Qty_1 AS INMat, { fn IFNULL(Qty_5, 0) } AS OUTMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg,
                         DetailTime AS DocTime, Qty_3 AS BalMat, Qty_4 AS BalPcs, RegID, TrcTypeID, MonthID, TrcID, LineID, Amount, BalAmount
FROM            dbo.QTD_Transaction
WHERE        (TrcTypeID = 400)
ORDER BY DocDate

GO

/****** Object:  View [dbo].[SCToolRoom_OUT]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCToolRoom_OUT]
AS
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, Qty_1 AS OUTMat, { fn IFNULL(Qty_5, 0) } AS INMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg,
                         DetailTime AS DocTime, Qty_3 AS BalMat, Qty_4 AS BalPcs, RegID, TrcTypeID, MonthID, TrcID, LineID, Amount, BalAmount
FROM            dbo.QTD_Transaction
WHERE        (TrcTypeID = 500)
ORDER BY DocDate

GO

/****** Object:  View [dbo].[SCToolRoom_Ext]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCToolRoom_Ext]
AS
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, INMat, OUTMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg, DocTime, TrcTypeID, MonthID, TrcID,
                         LineID, Amount, BalAmount
FROM            dbo.SCToolRoom_IN
UNION
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, INMat, OUTMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg, DocTime, TrcTypeID, MonthID, TrcID,
                         LineID, Amount, BalAmount
FROM            dbo.SCToolRoom_OUT

GO

/****** Object:  View [dbo].[Q_G1_Proc]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[Q_G1_Proc]
AS
SELECT        dbo.T500_Proc.C010_TrcTypeID, dbo.T500_Proc.C011_Month, dbo.T500_Proc.C000_SysID, dbo.T500_Proc.C050_Rev, dbo.T500_Proc.C013_TrcTypeSrcID, dbo.T500_Proc.C013_DraftReadyApprCancel,
                         dbo.T500_Proc.C014_ActMgrID, dbo.T500_Proc.C017_UserGrpFlowID_From, dbo.T500_Proc.C017_UserGrpFlowID_To, dbo.T500_Proc.C017_UserGrpFlowFrom, dbo.T500_Proc.C017_UserGrpFlowTo,
                         dbo.T500_Proc.C018_FlowTypeID, dbo.T500_Proc.C018_KanbanPostID, dbo.T500_Proc.C045_UserID, dbo.T500_Proc.C045_UserName, dbo.T500_Proc.C045_DTime, dbo.T500_Proc.C045_DTimeLasUpdate,
                         dbo.T500_Proc.C045_UserNameUpdate, dbo.T500_Proc.C050_DocNum, dbo.T500_Proc.C050_DocDate, dbo.T500_Proc.C050_AccountDate, dbo.T500_Proc.C050_ExtDocNum, dbo.T500_Proc.C050_ExtDocDate,
                         dbo.T500_Proc.C050_ExtDocNum1, dbo.T500_Proc.C050_ExtDocDate1, dbo.T500_Proc.C051_PONum, dbo.T500_Proc.C051_FakturNum, dbo.T500_Proc.C051_FakturDateTax, dbo.T500_Proc.C051_DueDate,
                         dbo.T500_Proc.C052_TermOfPayment, dbo.T500_Proc.C059_Remark, dbo.T500_Proc.C060_PartnerID, dbo.T500_Proc.C061_PICName, dbo.T500_Proc.C062_ActFixedAssetID,
                         dbo.T100_FixedAsset.Descr AS ActFixedAsset, dbo.M_Partner.PartnerCode, dbo.M_Partner.PartnerCode AS PartnerRef, dbo.M_Partner.PartnerName, dbo.M_Partner.Address, dbo.T500_Proc.C070_CurrencyID,
                         dbo.M_Currency.Code AS Currency, dbo.M_Currency.Desimal, dbo.M_Currency.Desimal2, dbo.M_Currency.TitikKoma, dbo.T500_Proc.C071_Rate, dbo.T500_Proc.C072_RateTax,
                         dbo.M_Currency.Rate AS RateMaster, dbo.T500_Proc.C073_Amount, dbo.T500_Proc.C073_AmountBruto, dbo.T500_Proc.C074_AmountDiscount,
                         dbo.T500_Proc.C073_Amount - dbo.T500_Proc.C074_AmountDiscount AS NetAmount, dbo.T500_Proc.C074_Expense, dbo.T500_Proc.C075_AmountPpn, dbo.T500_Proc.C075_AmountPph,
                         dbo.T500_Proc.C076_AmountFinal, dbo.T500_Proc.C077_AmountBalance, dbo.T500_Proc.C051_PONum AS PORef, dbo.T500_Proc.C080_PRCategoryID, dbo.T064_PRCategory.Sub1 AS Cat1,
                         dbo.T064_PRCategory.Sub2 AS Cat2, dbo.T500_Proc.C085_isPPN, dbo.T077_PostCategory.PostCategory, dbo.T500_Proc.C090_EstDlvDate, dbo.T500_Proc.C113_PRType, dbo.T500_Proc.SLedgerID,
                         dbo.T500_Proc.MLedgerID, dbo.T500_Proc.SubLedger1ID, dbo.T500_Proc.SubLedger2ID, dbo.T500_Proc.PostCategoryID, dbo.T_77_MLedger.Descr AS CashBank, dbo.T_77_MLedger_Sub1.Descr AS Account,
                         ISNULL(dbo.M_Partner.PartnerCode + N', ', N'') + ISNULL(dbo.T500_Proc.C051_FakturNum + N', ', N'') + ISNULL(dbo.T500_Proc.C050_ExtDocNum, N'') AS PostDescr, ISNULL(LEFT(dbo.M_Partner.PartnerName,
                         93) + N', ', N'') + ISNULL(dbo.T500_Proc.C050_ExtDocNum, N'') + ISNULL(LEFT(dbo.T500_Proc.Remark_PR, 220), N'') AS GR_Descr,
                         '(' + dbo.M_Partner.PartnerName + ') Payment ' + ISNULL(dbo.T500_Proc.C050_ExtDocNum, N'') AS Payment_Descr, dbo.T_77_MLedger.Descr AS AccountRef, dbo.T500_Proc.Remark_PR,
                         dbo.T_77_MLedger.Descr AS AP_Account, dbo.T500_Proc.C050_ExtDocNum1 AS FinanceRef, dbo.T500_Proc.YearIdx, dbo.T500_Proc.DeptID, dbo.Q093_CostCenter.Budget,
                         dbo.Q093_CostCenter.AmountUsage AS AmtBudgetUsage, dbo.Q093_CostCenter.AmountAvail, dbo.M_Partner.Telp, dbo.M_Partner.Fax
FROM            dbo.M_Partner RIGHT OUTER JOIN
                         dbo.T077_PostCategory RIGHT OUTER JOIN
                         dbo.Q093_CostCenter RIGHT OUTER JOIN
                         dbo.T500_Proc ON dbo.Q093_CostCenter.DeptID = dbo.T500_Proc.DeptID AND dbo.Q093_CostCenter.YearIdx = dbo.T500_Proc.YearIdx LEFT OUTER JOIN
                         dbo.Q680_SummaryBudget ON dbo.T500_Proc.DeptID = dbo.Q680_SummaryBudget.DeptID AND dbo.T500_Proc.YearIdx = dbo.Q680_SummaryBudget.YearIdx LEFT OUTER JOIN
                         dbo.T_77_MLedger ON dbo.T500_Proc.MLedgerID = dbo.T_77_MLedger.SysID LEFT OUTER JOIN
                         dbo.T100_FixedAsset RIGHT OUTER JOIN
                         dbo.T106_FA_Activity ON dbo.T100_FixedAsset.SysID = dbo.T106_FA_Activity.FixedAssetID ON dbo.T500_Proc.C062_ActFixedAssetID = dbo.T106_FA_Activity.SysID LEFT OUTER JOIN
                         dbo.T_77_MLedger_Sub1 ON dbo.T500_Proc.SubLedger1ID = dbo.T_77_MLedger_Sub1.SysID AND dbo.T500_Proc.MLedgerID = dbo.T_77_MLedger_Sub1.MLedgerID LEFT OUTER JOIN
                         dbo.T064_PRCategory ON dbo.T500_Proc.C080_PRCategoryID = dbo.T064_PRCategory.SysID ON dbo.T077_PostCategory.SysID = dbo.T500_Proc.PostCategoryID ON
                         dbo.M_Partner.SysID = dbo.T500_Proc.C060_PartnerID LEFT OUTER JOIN
                         dbo.M_Currency ON dbo.T500_Proc.C070_CurrencyID = dbo.M_Currency.SysID

GO

/****** Object:  View [dbo].[SCToolRoom]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCToolRoom]
AS
SELECT        TOP (100) PERCENT dbo.SCToolRoom_Ext.DocNum, dbo.SCToolRoom_Ext.DetailDocNum, dbo.SCToolRoom_Ext.DocDate, dbo.SCToolRoom_Ext.DocTime, dbo.SCToolRoom_Ext.ItemID,
                         dbo.SCToolRoom_Ext.PartNo, dbo.SCToolRoom_Ext.PartName, dbo.SCToolRoom_Ext.INMat, dbo.SCToolRoom_Ext.OUTMat, dbo.SCToolRoom_Ext.IDCust, dbo.SCToolRoom_Ext.Code,
                         dbo.SCToolRoom_Ext.CustName, dbo.SCToolRoom_Ext.Spec1, dbo.SCToolRoom_Ext.Spec2, dbo.SCToolRoom_Ext.PcsPerSheet, dbo.SCToolRoom_Ext.PcsPerKg, dbo.SCToolRoom_Ext.TrcTypeID,
                         dbo.SCToolRoom_Ext.MonthID, dbo.SCToolRoom_Ext.TrcID, dbo.SCToolRoom_Ext.LineID, dbo.SCToolRoom_Ext.Amount, dbo.SCToolRoom_Ext.BalAmount, dbo.M_Category.category_name AS Category
FROM            dbo.M_Category RIGHT OUTER JOIN
                         dbo.M_Product ON dbo.M_Category.id = dbo.M_Product.IDCategory RIGHT OUTER JOIN
                         dbo.SCToolRoom_Ext ON dbo.M_Product.RegID = dbo.SCToolRoom_Ext.ItemID
ORDER BY dbo.SCToolRoom_Ext.DocDate, dbo.SCToolRoom_Ext.DocTime

GO

/****** Object:  View [dbo].[StockTR]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[StockTR]
AS
SELECT        dbo.M_Product.RegID AS ItemID, dbo.M_Product.PartNo, dbo.M_Product.PartName, dbo.M_Product.Spec1, dbo.M_Product.Spec2, dbo.M_Product.PcsPerSheet, dbo.M_Product.PcsPerKg, dbo.M_Product.IDCust,
                         dbo.M_Product.IDProject, dbo.M_Product.IDCategory, dbo.M_Product.IsStoreRoom, dbo.M_Product.IsActive, dbo.M_Product.Price, dbo.M_Product.PcsPerday, dbo.M_Product.Min, dbo.M_Product.Max,
                         dbo.M_Customer.Code, dbo.M_Customer.CustName, { fn IFNULL(SUM(dbo.SCToolRoom_IN.BalMat), 0) } AS BalMat, { fn IFNULL(SUM(dbo.SCToolRoom_IN.BalPcs), 0) } AS BalPcs,
                         SUM(dbo.SCToolRoom_IN.Amount) AS Amount, SUM(dbo.SCToolRoom_IN.BalAmount) AS BalAmount, dbo.M_Category.category_name AS Category
FROM            dbo.M_Product LEFT OUTER JOIN
                         dbo.M_Category ON dbo.M_Product.IDCategory = dbo.M_Category.id LEFT OUTER JOIN
                         dbo.SCToolRoom_IN ON dbo.M_Product.RegID = dbo.SCToolRoom_IN.ItemID LEFT OUTER JOIN
                         dbo.M_Customer ON dbo.M_Product.IDCust = dbo.M_Customer.RegID
GROUP BY dbo.M_Product.RegID, dbo.M_Product.PartNo, dbo.M_Product.PartName, dbo.M_Product.Spec1, dbo.M_Product.Spec2, dbo.M_Product.PcsPerSheet, dbo.M_Product.PcsPerKg, dbo.M_Product.IDCust,
                         dbo.M_Product.IDProject, dbo.M_Product.IDCategory, dbo.M_Product.IsStoreRoom, dbo.M_Product.IsStoreRoom, dbo.M_Product.IsActive, dbo.M_Product.Price, dbo.M_Product.PcsPerday, dbo.M_Product.Min,
                         dbo.M_Product.Max, dbo.M_Customer.Code, dbo.M_Customer.CustName, dbo.M_Category.category_name
HAVING        (dbo.M_Product.IsActive = 1) AND (dbo.M_Product.IsStoreRoom = 1)

GO

/****** Object:  View [dbo].[Q_G2_Proc]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[Q_G2_Proc]
AS
SELECT        dbo.T510_Proc.C010_TrcTypeID, dbo.T510_Proc.C011_Month, dbo.T510_Proc.C012_TrcID, dbo.T510_Proc.C050_Rev, dbo.T510_Proc.C000_SysID, dbo.T510_Proc.C000_LineSrc, dbo.T510_Proc.C063_dtDelivery,
                         dbo.T510_Proc.C100_ItemIntID, dbo.Q01_MProduct.JobNum AS JobNum_Out, dbo.Q01_MProduct.PartNo AS ItemNum_Out, dbo.Q01_MProduct.PartNo AS SubNum_Out,
                         dbo.Q01_MProduct.PartName AS ItemName_Out, dbo.Q01_MProduct.IDUnit AS UnitID_Out, dbo.Q01_MProduct.CodeUnit AS Unit_Out, dbo.Q01_MProduct.CurrencyID AS CurrencyID_Out,
                         dbo.Q01_MProduct.Currency AS Currency_Out, dbo.T510_Proc.C100_ItemExtID, dbo.Q01_MProduct.JobNum AS JobNum_Req, dbo.Q01_MProduct.PartNo AS ItemNum_Req,
                         dbo.Q01_MProduct.PartNo AS SubNum_Req, dbo.Q01_MProduct.PartName AS ItemName_Req, dbo.Q01_MProduct.JobNum AS ItemKanbanID_Req, dbo.Q01_MProduct.IDUnit_Buy AS UnitID_Req,
                         dbo.Q01_MProduct.code_buy AS Unit_Req, dbo.Q01_MProduct.CurrencyID AS CurrencyID_Req, dbo.Q01_MProduct.Currency AS Currency_Req, dbo.T510_Proc.C100_ItemNameUser, dbo.T510_Proc.C105_Note,
                         dbo.T510_Proc.C102_PriceInt, dbo.T510_Proc.C110_Qty, dbo.T510_Proc.C110_Qty2, dbo.T510_Proc.C111_QtyBal, dbo.T510_Proc.C125_AmountInt, dbo.Q01_MProduct.Desimal,
                         dbo.Q01_MProduct.TitikKoma, NULL AS PartnerID, dbo.T510_Proc.C126_ValDiscount, dbo.T510_Proc.C127_AmountDiscount, dbo.T510_Proc.C130_MLedgerID, dbo.T510_Proc.C131_SubLedger1ID,
                         dbo.T510_Proc.C132_SubLedger2ID, dbo.T510_Proc.C140_KategoryID, dbo.T510_Proc.C150_UnitConvertion, dbo.T510_Proc.C160_PRType, dbo.Q01_MProduct.Convertion AS QtyReqToOut,
                         dbo.Q01_MProduct.Convertion AS QtyOutToReq, dbo.Q01_MProduct.Spec1, dbo.Q01_MProduct.Spec2
FROM            dbo.T510_Proc LEFT OUTER JOIN
                         dbo.Q01_MProduct ON dbo.T510_Proc.C100_ItemIntID = dbo.Q01_MProduct.RegID

GO

/****** Object:  View [dbo].[SCGA_IN]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCGA_IN]
AS
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, Qty_1 AS INMat, { fn IFNULL(Qty_5, 0) } AS OUTMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg,
                         DetailTime AS DocTime, Qty_3 AS BalMat, Qty_4 AS BalPcs, RegID, TrcTypeID, MonthID, TrcID, LineID, Amount, BalAmount
FROM            dbo.QTD_Transaction
WHERE        (TrcTypeID = 600)
ORDER BY DocDate

GO

/****** Object:  View [dbo].[SCGA_OUT]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCGA_OUT]
AS
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, Qty_1 AS OUTMat, { fn IFNULL(Qty_5, 0) } AS INMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg,
                         DetailTime AS DocTime, Qty_3 AS BalMat, Qty_4 AS BalPcs, RegID, TrcTypeID, MonthID, TrcID, LineID, Amount, BalAmount
FROM            dbo.QTD_Transaction
WHERE        (TrcTypeID = 700)
ORDER BY DocDate

GO

/****** Object:  View [dbo].[SCGA_Ext]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCGA_Ext]
AS
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, INMat, OUTMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg, DocTime, TrcTypeID, MonthID, TrcID, LineID,
                         Amount, BalAmount
FROM            dbo.SCGA_IN
UNION
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, INMat, OUTMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg, DocTime, TrcTypeID, MonthID, TrcID, LineID,
                         Amount, BalAmount
FROM            dbo.SCGA_OUT

GO

/****** Object:  View [dbo].[SCGA]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCGA]
AS
SELECT        TOP (100) PERCENT dbo.SCGA_Ext.DocNum, dbo.SCGA_Ext.DetailDocNum, dbo.SCGA_Ext.DocDate, dbo.SCGA_Ext.DocTime, dbo.SCGA_Ext.ItemID, dbo.SCGA_Ext.PartNo, dbo.SCGA_Ext.PartName,
                         dbo.SCGA_Ext.INMat, dbo.SCGA_Ext.OUTMat, dbo.SCGA_Ext.IDCust, dbo.SCGA_Ext.Code, dbo.SCGA_Ext.CustName, dbo.SCGA_Ext.Spec1, dbo.SCGA_Ext.Spec2, dbo.SCGA_Ext.PcsPerSheet,
                         dbo.SCGA_Ext.PcsPerKg, dbo.SCGA_Ext.TrcTypeID, dbo.SCGA_Ext.MonthID, dbo.SCGA_Ext.TrcID, dbo.SCGA_Ext.LineID, dbo.SCGA_Ext.Amount, dbo.SCGA_Ext.BalAmount,
                         dbo.M_Category.category_name AS Category
FROM            dbo.M_Category RIGHT OUTER JOIN
                         dbo.M_Product ON dbo.M_Category.id = dbo.M_Product.IDCategory RIGHT OUTER JOIN
                         dbo.SCGA_Ext ON dbo.M_Product.RegID = dbo.SCGA_Ext.ItemID
ORDER BY dbo.SCGA_Ext.DocDate, dbo.SCGA_Ext.DocTime

GO

/****** Object:  View [dbo].[StockGA]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[StockGA]
AS
SELECT        dbo.M_Product.RegID AS ItemID, dbo.M_Product.PartNo, dbo.M_Product.PartName, dbo.M_Product.Spec1, dbo.M_Product.Spec2, dbo.M_Product.PcsPerSheet, dbo.M_Product.PcsPerKg, dbo.M_Product.IDCust,
                         dbo.M_Product.IDProject, dbo.M_Product.IDCategory, dbo.M_Product.IsGA, dbo.M_Product.IsActive, dbo.M_Product.Price, dbo.M_Product.PcsPerday, dbo.M_Product.Min, dbo.M_Product.Max,
                         dbo.M_Customer.Code, dbo.M_Customer.CustName, { fn IFNULL(SUM(dbo.SCGA_IN.BalMat), 0) } AS BalMat, { fn IFNULL(SUM(dbo.SCGA_IN.BalPcs), 0) } AS BalPcs, SUM(dbo.SCGA_IN.Amount) AS Amount,
                         SUM(dbo.SCGA_IN.BalAmount) AS BalAmount, dbo.M_Category.category_name AS Category
FROM            dbo.M_Product LEFT OUTER JOIN
                         dbo.M_Category ON dbo.M_Product.IDCategory = dbo.M_Category.id LEFT OUTER JOIN
                         dbo.SCGA_IN ON dbo.M_Product.RegID = dbo.SCGA_IN.ItemID LEFT OUTER JOIN
                         dbo.M_Customer ON dbo.M_Product.IDCust = dbo.M_Customer.RegID
GROUP BY dbo.M_Product.RegID, dbo.M_Product.PartNo, dbo.M_Product.PartName, dbo.M_Product.Spec1, dbo.M_Product.Spec2, dbo.M_Product.PcsPerSheet, dbo.M_Product.PcsPerKg, dbo.M_Product.IDCust,
                         dbo.M_Product.IDProject, dbo.M_Product.IDCategory, dbo.M_Product.IsGA, dbo.M_Product.IsStoreRoom, dbo.M_Product.IsStoreRoom, dbo.M_Product.IsActive, dbo.M_Product.Price, dbo.M_Product.PcsPerday,
                         dbo.M_Product.Min, dbo.M_Product.Max, dbo.M_Customer.Code, dbo.M_Customer.CustName, dbo.M_Category.category_name
HAVING        (dbo.M_Product.IsActive = 1) AND (dbo.M_Product.IsGA = 1)

GO

/****** Object:  View [dbo].[SCICT_IN]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCICT_IN]
AS
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, Qty_1 AS INMat, { fn IFNULL(Qty_5, 0) } AS OUTMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg,
                         DetailTime AS DocTime, Qty_3 AS BalMat, Qty_4 AS BalPcs, RegID, TrcTypeID, MonthID, TrcID, LineID, Amount, BalAmount
FROM            dbo.QTD_Transaction
WHERE        (TrcTypeID = 800)
ORDER BY DocDate

GO

/****** Object:  View [dbo].[SCICT_OUT]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCICT_OUT]
AS
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, Qty_1 AS OUTMat, { fn IFNULL(Qty_5, 0) } AS INMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg,
                         DetailTime AS DocTime, Qty_3 AS BalMat, Qty_4 AS BalPcs, RegID, TrcTypeID, MonthID, TrcID, LineID, Amount, BalAmount
FROM            dbo.QTD_Transaction
WHERE        (TrcTypeID = 900)
ORDER BY DocDate

GO

/****** Object:  View [dbo].[SCICT_Ext]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCICT_Ext]
AS
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, INMat, OUTMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg, DocTime, TrcTypeID, MonthID, TrcID, LineID,
                         Amount, BalAmount
FROM            dbo.SCICT_IN
UNION
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, INMat, OUTMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg, DocTime, TrcTypeID, MonthID, TrcID, LineID,
                         Amount, BalAmount
FROM            dbo.SCICT_OUT

GO

/****** Object:  View [dbo].[SCICT]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCICT]
AS
SELECT        TOP (100) PERCENT dbo.SCICT_Ext.DocNum, dbo.SCICT_Ext.DetailDocNum, dbo.SCICT_Ext.DocDate, dbo.SCICT_Ext.DocTime, dbo.SCICT_Ext.ItemID, dbo.SCICT_Ext.PartNo, dbo.SCICT_Ext.PartName,
                         dbo.SCICT_Ext.INMat, dbo.SCICT_Ext.OUTMat, dbo.SCICT_Ext.IDCust, dbo.SCICT_Ext.Code, dbo.SCICT_Ext.CustName, dbo.SCICT_Ext.Spec1, dbo.SCICT_Ext.Spec2, dbo.SCICT_Ext.PcsPerSheet,
                         dbo.SCICT_Ext.PcsPerKg, dbo.SCICT_Ext.TrcTypeID, dbo.SCICT_Ext.MonthID, dbo.SCICT_Ext.TrcID, dbo.SCICT_Ext.LineID, dbo.SCICT_Ext.Amount, dbo.SCICT_Ext.BalAmount,
                         dbo.M_Category.category_name AS Category
FROM            dbo.M_Category RIGHT OUTER JOIN
                         dbo.M_Product ON dbo.M_Category.id = dbo.M_Product.IDCategory RIGHT OUTER JOIN
                         dbo.SCICT_Ext ON dbo.M_Product.RegID = dbo.SCICT_Ext.ItemID
ORDER BY dbo.SCICT_Ext.DocDate, dbo.SCICT_Ext.DocTime

GO

/****** Object:  View [dbo].[StockICT]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[StockICT]
AS
SELECT        dbo.M_Product.RegID AS ItemID, dbo.M_Product.PartNo, dbo.M_Product.PartName, dbo.M_Product.Spec1, dbo.M_Product.Spec2, dbo.M_Product.PcsPerSheet, dbo.M_Product.PcsPerKg, dbo.M_Product.IDCust,
                         dbo.M_Product.IDProject, dbo.M_Product.IDCategory, dbo.M_Product.IsICT, dbo.M_Product.IsActive, dbo.M_Product.Price, dbo.M_Product.PcsPerday, dbo.M_Product.Min, dbo.M_Product.Max,
                         dbo.M_Customer.Code, dbo.M_Customer.CustName, { fn IFNULL(SUM(dbo.SCICT_IN.BalMat), 0) } AS BalMat, { fn IFNULL(SUM(dbo.SCICT_IN.BalPcs), 0) } AS BalPcs, SUM(dbo.SCICT_IN.Amount) AS Amount,
                         SUM(dbo.SCICT_IN.BalAmount) AS BalAmount, dbo.M_Category.category_name AS Category
FROM            dbo.M_Product LEFT OUTER JOIN
                         dbo.M_Category ON dbo.M_Product.IDCategory = dbo.M_Category.id LEFT OUTER JOIN
                         dbo.SCICT_IN ON dbo.M_Product.RegID = dbo.SCICT_IN.ItemID LEFT OUTER JOIN
                         dbo.M_Customer ON dbo.M_Product.IDCust = dbo.M_Customer.RegID
GROUP BY dbo.M_Product.RegID, dbo.M_Product.PartNo, dbo.M_Product.PartName, dbo.M_Product.Spec1, dbo.M_Product.Spec2, dbo.M_Product.PcsPerSheet, dbo.M_Product.PcsPerKg, dbo.M_Product.IDCust,
                         dbo.M_Product.IDProject, dbo.M_Product.IDCategory, dbo.M_Product.IsICT, dbo.M_Product.IsStoreRoom, dbo.M_Product.IsStoreRoom, dbo.M_Product.IsActive, dbo.M_Product.Price, dbo.M_Product.PcsPerday,
                         dbo.M_Product.Min, dbo.M_Product.Max, dbo.M_Customer.Code, dbo.M_Customer.CustName, dbo.M_Category.category_name
HAVING        (dbo.M_Product.IsActive = 1) AND (dbo.M_Product.IsICT = 1)

GO

/****** Object:  View [dbo].[SCWIP_IN]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCWIP_IN]
AS
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, Qty_1 AS INMat, 0 AS OUTMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg, DetailTime AS DocTime,
                         Qty_3 AS BalMat, Qty_4 AS BalPcs, RegID, TrcTypeID, MonthID, TrcID, LineID
FROM            dbo.QTD_Transaction
WHERE        (TrcTypeID = 1200)
ORDER BY DocDate

GO

/****** Object:  View [dbo].[SCWIP_OUT]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCWIP_OUT]
AS
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, Qty_1 AS OUTMat, 0 AS INMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg, DetailTime AS DocTime,
                         Qty_3 AS BalMat, Qty_4 AS BalPcs, RegID, TrcTypeID, MonthID, TrcID, LineID
FROM            dbo.QTD_Transaction
WHERE        (TrcTypeID = 1300)
ORDER BY DocDate

GO

/****** Object:  View [dbo].[SCWIP_Ext]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCWIP_Ext]
AS
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, INMat, OUTMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg, DocTime, TrcTypeID, MonthID, TrcID,
                         LineID
FROM            dbo.SCWIP_IN
UNION
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, INMat, OUTMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg, DocTime, TrcTypeID, MonthID, TrcID,
                         LineID
FROM            dbo.SCWIP_OUT

GO

/****** Object:  View [dbo].[SCWIP]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCWIP]
AS
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, DocTime, ItemID, PartNo, PartName, INMat, OUTMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg, TrcTypeID, MonthID, TrcID,
                         LineID
FROM            dbo.SCWIP_Ext
ORDER BY DocDate, DocTime

GO

/****** Object:  View [dbo].[SCRawMaterial_Ext]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCRawMaterial_Ext]
AS
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, INMat, OUTMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg, DocTime, TrcTypeID, MonthID, TrcID, LineID
FROM            dbo.SCMaterial_IN
UNION
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, ItemID, PartNo, PartName, INMat, OUTMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg, DocTime, TrcTypeID, MonthID, TrcID, LineID
FROM            dbo.SCMaterial_OUT

GO

/****** Object:  View [dbo].[SCRawMaterial]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SCRawMaterial]
AS
SELECT        TOP (100) PERCENT DocNum, DetailDocNum, DocDate, DocTime, ItemID, PartNo, PartName, INMat, OUTMat, IDCust, Code, CustName, Spec1, Spec2, PcsPerSheet, PcsPerKg, TrcTypeID, MonthID, TrcID,
                         LineID
FROM            dbo.SCRawMaterial_Ext
ORDER BY DocDate, DocTime

GO

/****** Object:  View [dbo].[SumRM]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[SumRM]
AS
SELECT        ItemID, Qty_1 AS QtyMat, DocDate, TrcTypeID
FROM            dbo.QTD_Transaction

GO

/****** Object:  View [dbo].[WIPStock]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[WIPStock]
AS
SELECT        dbo.M_Product.RegID AS ItemID, dbo.M_Product.PartNo, dbo.M_Product.PartName, dbo.M_Product.IDCust, dbo.M_Partner.PartnerCode AS Code, dbo.M_Partner.PartnerName AS CustName,
                         { fn IFNULL(SUM(dbo.SCWIP.INMat), 0) } AS [IN], { fn IFNULL(SUM(dbo.SCWIP.OUTMat), 0) } AS OUT, dbo.M_Product.PcsPerday, dbo.M_Product.IsActive, dbo.M_Product.StdPack, dbo.M_Product.StockWip,
                         dbo.M_Project.ProjectName
FROM            dbo.M_Product LEFT OUTER JOIN
                         dbo.M_Partner ON dbo.M_Product.IDCust = dbo.M_Partner.SysID LEFT OUTER JOIN
                         dbo.M_Project ON dbo.M_Product.IDProject = dbo.M_Project.RegID LEFT OUTER JOIN
                         dbo.SCWIP ON dbo.M_Product.RegID = dbo.SCWIP.ItemID
WHERE        (dbo.M_Product.IsActive = 1) AND (dbo.M_Product.IsWIP = 1)
GROUP BY dbo.M_Product.RegID, dbo.M_Product.PartNo, dbo.M_Product.PartName, dbo.M_Product.PcsPerday, dbo.M_Product.StockWip, dbo.M_Product.IsActive, dbo.M_Product.StdPack, dbo.M_Project.ProjectName,
                         dbo.M_Partner.PartnerCode, dbo.M_Partner.PartnerName, dbo.M_Product.IDCust

GO

/****** Object:  View [dbo].[DetailMachine]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[DetailMachine]
AS
SELECT        dbo.M_Machine.RegID, dbo.M_Machine.Code, dbo.M_Machine.McName, dbo.M_Machine.Tonage, dbo.M_Machine.IDLine, dbo.M_Machine.DetailLine, dbo.M_Machine.IsActive, dbo.M_Line.Line, dbo.M_Line.Category,
                         dbo.M_Line.Factory
FROM            dbo.M_Machine INNER JOIN
                         dbo.M_Line ON dbo.M_Machine.IDLine = dbo.M_Line.IDLine

GO

/****** Object:  View [dbo].[IMSUser]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[IMSUser]
AS
SELECT        TOP (100) PERCENT dbo.M_User.RegID, dbo.M_User.username, dbo.M_User.id_user, dbo.M_User.password, dbo.M_User.nama_lengkap, dbo.M_User.[level] AS IDLevel, dbo.M_User.blokir AS IDBlokir, dbo.M_User.foto,
                         dbo.M_User.id_dept, dbo.M_User.password2, dbo.M_Department.Dept_Code, dbo.M_Department.Dept_Name AS dept, M_DetailStatus_1.Detail AS Blokir, dbo.M_Level.[level], dbo.M_User.IsStoreRoom, dbo.M_User.Code,
                         dbo.M_User.MUserTR, dbo.M_User.MUser, dbo.M_User.MProdMaterial, dbo.M_User.MProdStamping, dbo.M_User.MProdWelding, dbo.M_User.MProdDelivery, dbo.M_User.MProdStoreRoom, dbo.M_User.MPartner,
                         dbo.M_User.MCategory, dbo.M_User.MUnit, dbo.M_User.MCust, dbo.M_User.TrcMaterial, dbo.M_User.TrcStamping, dbo.M_User.TrcWelding, dbo.M_User.TrcWH, dbo.M_User.TrcStoreRoom, dbo.M_User.TrcGA,
                         dbo.M_User.TrcMTC, dbo.M_User.CanEditMaster, dbo.M_User.CanEditDoc, dbo.M_User.CanEditManUser, dbo.M_User.TrcICT, dbo.M_User.MProdICT, dbo.M_User.MProdGA, dbo.M_User.MProduct, dbo.M_User.MUtility,
                         dbo.M_User.MUserIMS, dbo.M_User.TrcWIP, dbo.M_User.IsDelete, dbo.M_User.CanEditDocAdmin, dbo.M_User.MAsset, dbo.M_User.TrcAsset, dbo.M_User.MBom, dbo.M_User.TrcSony, dbo.M_User.TrcProduction,
                         dbo.M_User.Activation, dbo.M_User.Email, dbo.M_User.DailyGAP, dbo.M_User.TrcBPFG, dbo.M_User.area
FROM            dbo.M_User LEFT OUTER JOIN
                         dbo.M_DetailStatus AS M_DetailStatus_1 ON dbo.M_User.blokir = M_DetailStatus_1.RegID LEFT OUTER JOIN
                         dbo.M_Level ON dbo.M_User.[level] = dbo.M_Level.id_level LEFT OUTER JOIN
                         dbo.M_Department ON dbo.M_User.id_dept = dbo.M_Department.id
WHERE        (dbo.M_User.IsDelete = N'X') AND (dbo.M_User.Activation = 1)
ORDER BY dbo.M_User.RegID DESC

GO

/****** Object:  View [dbo].[ListPicTR]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[ListPicTR]
AS
SELECT        dbo.M_Department.Dept_Code, dbo.M_Department.Dept_Name, dbo.M_UserG5.SysID, dbo.M_UserG5.FullName, dbo.M_UserG5.IsStoreRoom, dbo.M_UserG5.UserName
FROM            dbo.M_Department RIGHT OUTER JOIN
                         dbo.M_UserG5 ON dbo.M_Department.id = dbo.M_UserG5.DeptID
WHERE        (dbo.M_UserG5.IsStoreRoom = 1)

GO

/****** Object:  View [dbo].[M_CustMaterial]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[M_CustMaterial]
AS
SELECT        COUNT(dbo.M_Product.IDCust) AS Count, dbo.M_Partner.SysID AS RegID, dbo.M_Partner.PartnerCode AS Code, dbo.M_Partner.PartnerName AS CustName
FROM            dbo.M_Product INNER JOIN
                         dbo.M_Partner ON dbo.M_Product.IDCust = dbo.M_Partner.SysID
WHERE        (dbo.M_Product.IsActive = 1) AND (dbo.M_Product.IsMaterial = 1)
GROUP BY dbo.M_Partner.SysID, dbo.M_Partner.PartnerCode, dbo.M_Partner.PartnerName
HAVING        (COUNT(dbo.M_Product.IDCust) > 0)

GO

/****** Object:  View [dbo].[M_CustWareHouse]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[M_CustWareHouse]
AS
SELECT        TOP (100) PERCENT COUNT(dbo.M_Product.IDCust) AS Count, dbo.M_Partner.SysID AS RegID, dbo.M_Partner.PartnerCode AS Code, dbo.M_Partner.PartnerName AS CustName
FROM            dbo.M_Product INNER JOIN
                         dbo.M_Partner ON dbo.M_Product.IDCust = dbo.M_Partner.SysID
WHERE        (dbo.M_Product.IsActive = 1) AND (dbo.M_Product.IsDelivery = 1)
GROUP BY dbo.M_Partner.SysID, dbo.M_Partner.PartnerCode, dbo.M_Partner.PartnerName

GO

/****** Object:  View [dbo].[M_CustWIP]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[M_CustWIP]
AS
SELECT        COUNT(dbo.M_Product.IDCust) AS Count, dbo.M_Partner.SysID AS RegID, dbo.M_Partner.PartnerCode AS Code, dbo.M_Partner.PartnerName AS CustName, dbo.M_Product.IDCust
FROM            dbo.M_Product INNER JOIN
                         dbo.M_Partner ON dbo.M_Product.IDCust = dbo.M_Partner.SysID
WHERE        (dbo.M_Product.IsWIP = 1) AND (dbo.M_Product.IsActive = 1)
GROUP BY dbo.M_Partner.SysID, dbo.M_Partner.PartnerCode, dbo.M_Partner.PartnerName, dbo.M_Product.IDCust
HAVING        (COUNT(dbo.M_Product.IDCust) > 0)

GO

/****** Object:  View [dbo].[Master_BOM1]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[Master_BOM1]
AS
SELECT        TOP (100) PERCENT dbo.BOM1.SysID, dbo.BOM1.PartNo, dbo.BOM1.PartName, dbo.BOM1.IDCust, dbo.BOM1.Image, dbo.BOM1.IDProject, dbo.BOM1.PackingType, dbo.BOM1.PartTypeID, dbo.BOM1.StdPack,
                         dbo.BOM1.FGLocation, dbo.BOM1.CreateBy, dbo.BOM1.IsActive, dbo.BOM1.IsDelete, dbo.M_Customer.CustName, dbo.M_Project.ProjectName, dbo.BOM6.PartType, dbo.BOM1.QtyPerCar, dbo.BOM1.SupplierID,
                         dbo.M_Partner.PartnerName, dbo.M_Partner.PartnerCode, dbo.BOM1.ItemNo, dbo.M_Customer.Code
FROM            dbo.M_Customer RIGHT OUTER JOIN
                         dbo.M_Partner RIGHT OUTER JOIN
                         dbo.BOM1 ON dbo.BOM1.SupplierID = dbo.M_Partner.SysID LEFT OUTER JOIN
                         dbo.BOM6 ON dbo.BOM1.PartTypeID = dbo.BOM6.SysID ON dbo.M_Customer.RegID = dbo.BOM1.IDCust LEFT OUTER JOIN
                         dbo.M_Project ON dbo.BOM1.IDProject = dbo.M_Project.RegID
WHERE        (dbo.BOM1.IsDelete = 0)
ORDER BY dbo.BOM1.SysID DESC

GO

/****** Object:  View [dbo].[Q_77_MLedger_CashBank]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[Q_77_MLedger_CashBank]
AS
SELECT        SysID, Code, Descr
FROM            dbo.T_77_MLedger
WHERE        (ParentID = 40) OR
                         (ParentID = 70)

GO

/****** Object:  View [dbo].[Q_77_MLedger_Detail]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[Q_77_MLedger_Detail]
AS
SELECT        SysID, Code, Descr
FROM            dbo.T_77_MLedger
WHERE        (IsDetail = 1)

GO

/****** Object:  View [dbo].[Q_G2_Proc_Other]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[Q_G2_Proc_Other]
AS
SELECT        dbo.T510_Proc.C010_TrcTypeID, dbo.T510_Proc.C011_Month, dbo.T510_Proc.C012_TrcID, dbo.T510_Proc.C050_Rev, dbo.T510_Proc.C000_SysID, dbo.T510_Proc.C000_LineSrc, dbo.T510_Proc.C063_dtDelivery,
                         dbo.T510_Proc.C100_ItemIntID, dbo.M_Product.PartNo AS ItemNum, dbo.M_Product.PartName AS ItemName, dbo.M_Product.JobNum, dbo.T510_Proc.C100_ItemNameUser, dbo.M_Unit.code AS Unit,
                         dbo.M_Unit.code AS UnitRef, M_Unit_1.code AS BuyUnit, M_Unit_1.code AS BuyUnitRef, dbo.M_Currency.Code AS Currency, dbo.T510_Proc.C102_PriceInt, dbo.T510_Proc.C110_Qty, dbo.T510_Proc.C110_Qty2,
                         dbo.T510_Proc.C111_QtyBal, dbo.T510_Proc.C125_AmountInt, dbo.T510_Proc.C126_ValDiscount, dbo.T510_Proc.C127_AmountDiscount, dbo.T510_Proc.C128_NetAmount, dbo.T510_Proc.C130_MLedgerID,
                         dbo.T510_Proc.C135_Rate, dbo.M_Currency.Desimal, dbo.M_Currency.TitikKoma, dbo.T510_Proc.C150_UnitConvertion, dbo.T510_Proc.C105_Note, dbo.M_Product.Description, dbo.T510_Proc.PostCategoryID,
                         dbo.T077_PostCategory.PostCategory, dbo.T510_Proc.C160_PRType, dbo.T510_Proc.C140_KategoryID, dbo.T064_PRCategory.Sub1, dbo.T064_PRCategory.Sub2, dbo.T510_Proc.CostCenterID,
                         dbo.T094_CostCenterDetail.Descr AS CostCenter, dbo.T077_PostCategory.ItemGroupID
FROM            dbo.T094_CostCenterDetail RIGHT OUTER JOIN
                         dbo.T510_Proc ON dbo.T094_CostCenterDetail.SysID = dbo.T510_Proc.CostCenterID LEFT OUTER JOIN
                         dbo.T064_PRCategory ON dbo.T510_Proc.C140_KategoryID = dbo.T064_PRCategory.SysID LEFT OUTER JOIN
                         dbo.T077_PostCategory ON dbo.T510_Proc.PostCategoryID = dbo.T077_PostCategory.SysID LEFT OUTER JOIN
                         dbo.M_Unit AS M_Unit_1 RIGHT OUTER JOIN
                         dbo.M_Product ON M_Unit_1.id = dbo.M_Product.IDUnit_Buy LEFT OUTER JOIN
                         dbo.M_Currency ON dbo.M_Product.CurrencyID = dbo.M_Currency.SysID LEFT OUTER JOIN
                         dbo.M_Unit ON dbo.M_Product.IDUnit = dbo.M_Unit.id ON dbo.T510_Proc.C100_ItemIntID = dbo.M_Product.RegID
WHERE        (dbo.T510_Proc.C010_TrcTypeID >= 1010)

GO

/****** Object:  View [dbo].[Q077_PostCategory]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[Q077_PostCategory]
AS
SELECT        dbo.T077_PostCategory.SysID, dbo.T077_PostCategory.DocTypeID, dbo.PR_DocType.DocType, dbo.T077_PostCategory.PostCategory, dbo.T077_PostCategory.MLedgerID, dbo.T_77_MLedger.Code AS AccNum,
                         dbo.T_77_MLedger.Descr AS AccName, dbo.T077_PostCategory.TrcTypeID, dbo.T077_PostCategory.ItemGroupID, dbo.T066_ItemGroup.ItemGroup
FROM            dbo.T077_PostCategory LEFT OUTER JOIN
                         dbo.T066_ItemGroup ON dbo.T077_PostCategory.ItemGroupID = dbo.T066_ItemGroup.SysID LEFT OUTER JOIN
                         dbo.T_77_MLedger ON dbo.T077_PostCategory.MLedgerID = dbo.T_77_MLedger.SysID LEFT OUTER JOIN
                         dbo.PR_DocType ON dbo.T077_PostCategory.DocTypeID = dbo.PR_DocType.SysID

GO

/****** Object:  View [dbo].[Q094_CostCenterDetail]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[Q094_CostCenterDetail]
AS
SELECT        CostCenterID, SUM(Nominal) AS SumAmount
FROM            dbo.T094_CostCenterDetail
GROUP BY CostCenterID

GO

/****** Object:  View [dbo].[Q106_FA_Activity_InProgress]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[Q106_FA_Activity_InProgress]
AS
SELECT        dbo.T106_FA_Activity.SysID, dbo.T105_ActivityCategory.Descr AS Activity, dbo.T100_FixedAsset.Code, dbo.T100_FixedAsset.Descr, dbo.T101_GroupAsset.Descr AS GroupAsset, dbo.T106_FA_Activity.dtCreate,
                         dbo.T015_Department.Department, dbo.T015_Department.SysID AS DeptID
FROM            dbo.T106_FA_Activity INNER JOIN
                         dbo.T100_FixedAsset ON dbo.T106_FA_Activity.FixedAssetID = dbo.T100_FixedAsset.SysID INNER JOIN
                         dbo.T101_GroupAsset ON dbo.T100_FixedAsset.GroupAssetID = dbo.T101_GroupAsset.SysID LEFT OUTER JOIN
                         dbo.T105_ActivityCategory ON dbo.T106_FA_Activity.ActivityCategoryID = dbo.T105_ActivityCategory.SysID LEFT OUTER JOIN
                         dbo.T015_Department ON dbo.T106_FA_Activity.OwnerID = dbo.T015_Department.SysID
WHERE        (dbo.T106_FA_Activity.StatProgress = 1)

GO

/****** Object:  View [dbo].[Q610_Jurnal]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[Q610_Jurnal]
AS
SELECT        TOP (100) PERCENT dbo.T610_Trc.C012_TrcID AS PostingIdx, 3 AS C013_DraftReadyApprCancel, dbo.T610_Trc.C050_AccountDate AS TrcDate, dbo.T610_Trc.C050_DocNum AS RefDocNum,
                         dbo.T610_Trc.Description AS ActMgrObjTitle, dbo.T_77_MLedger.Code, dbo.T_77_MLedger.Descr AS Account, dbo.T_77_MLedger_Sub1.Code AS SubAcc1, dbo.T_77_MLedger_Sub2.Code AS SubAcc2,
                         dbo.T610_Trc.YearIdx, dbo.T610_Trc.MonthIdx, dbo.T610_Trc.AmountInTrc AS Debet, dbo.T610_Trc.AmountOutTrc AS Credit, dbo.T610_Trc.Currency, dbo.T610_Trc.Rate,
                         dbo.T610_Trc.AmountInLocal AS Debet_IDR, dbo.T610_Trc.AmountOutLocal AS Credit_IDR, 2 AS CurrDecimal, 1 AS TitikKoma, dbo.T610_Trc.C014_MonthPostIdx AS Idx, dbo.T610_Trc.C010_TrcTypeID,
                         dbo.T610_Trc.C012_TrcID AS C000_SysID, dbo.T610_Trc.C011_Month, dbo.T610_Trc.C050_Rev, dbo.T610_Trc.C045_UserName AS UserName, dbo.T_76_SLedger.Code AS SLedger,
                         dbo.T610_Trc.C015_DatePost AS C045_DTime, dbo.T610_Trc.MinPlus, dbo.T610_Trc.DocRef1 AS DocRef, dbo.T610_Trc.MLedgerID, dbo.T610_Trc.SubLedger1ID, dbo.T610_Trc.Description1,
                         dbo.T610_Trc.C000_SysID AS C000_SysIDX
FROM            dbo.T610_Trc LEFT OUTER JOIN
                         dbo.T_77_MLedger_Sub2 ON dbo.T610_Trc.SubLedger2ID = dbo.T_77_MLedger_Sub2.SysID AND dbo.T610_Trc.SubLedger1ID = dbo.T_77_MLedger_Sub2.SubLedgerID AND
                         dbo.T610_Trc.MLedgerID = dbo.T_77_MLedger_Sub2.MLedgerID LEFT OUTER JOIN
                         dbo.T_77_MLedger_Sub1 ON dbo.T610_Trc.SubLedger1ID = dbo.T_77_MLedger_Sub1.SysID AND dbo.T610_Trc.MLedgerID = dbo.T_77_MLedger_Sub1.MLedgerID LEFT OUTER JOIN
                         dbo.T_77_MLedger ON dbo.T610_Trc.MLedgerID = dbo.T_77_MLedger.SysID LEFT OUTER JOIN
                         dbo.T_76_SLedger ON dbo.T610_Trc.SLedgerID = dbo.T_76_SLedger.SysID

GO

/****** Object:  View [dbo].[QCMProduct_BOM1]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[QCMProduct_BOM1]
AS
SELECT        dbo.CMProduct_BOM.SysID, dbo.CMProduct_BOM.ItemID_Product, dbo.CMProduct_BOM.ItemID_BOM, dbo.BOM1.PartNo, dbo.BOM1.PartName, dbo.BOM1.PartTypeID, dbo.M_Project.ProjectName,
                         dbo.BOM1.IDCust, dbo.M_Partner.PartnerCode AS Code, dbo.M_Partner.PartnerName AS CustName
FROM            dbo.CMProduct_BOM INNER JOIN
                         dbo.BOM1 ON dbo.CMProduct_BOM.ItemID_BOM = dbo.BOM1.SysID AND LEFT(dbo.CMProduct_BOM.ItemID_BOM, 3) = 'SAI' INNER JOIN
                         dbo.M_Project ON dbo.M_Project.RegID = dbo.BOM1.IDProject INNER JOIN
                         dbo.M_Partner ON dbo.BOM1.IDCust = dbo.M_Partner.SysID

GO

/****** Object:  View [dbo].[QCMProduct_BOM2]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[QCMProduct_BOM2]
AS
SELECT        dbo.CMProduct_BOM.SysID, dbo.CMProduct_BOM.ItemID_Product, dbo.CMProduct_BOM.ItemID_BOM, dbo.BOM2.PartNo, dbo.BOM2.PartName, dbo.BOM2.PartType, dbo.BOM2.LinkID, dbo.BOM2.SpecOrder1,
                         dbo.BOM2.SpecOrder2, dbo.BOM1.IDCust, dbo.M_Partner.PartnerCode AS Code, dbo.M_Project.ProjectName
FROM            dbo.BOM1 LEFT OUTER JOIN
                         dbo.M_Project ON dbo.BOM1.IDProject = dbo.M_Project.RegID LEFT OUTER JOIN
                         dbo.M_Partner ON dbo.BOM1.IDCust = dbo.M_Partner.SysID RIGHT OUTER JOIN
                         dbo.BOM2 ON dbo.BOM1.SysID = dbo.BOM2.LinkID RIGHT OUTER JOIN
                         dbo.CMProduct_BOM ON dbo.BOM2.SysID = dbo.CMProduct_BOM.ItemID_BOM

GO

/****** Object:  View [dbo].[QDailyEmail_GAP_New]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[QDailyEmail_GAP_New]
AS
SELECT        PartnerCode, C050_DocNum, DelivDate, Line, ItemNum, ItemName, QtySO, AmountSO, QtyDelivery, AmountDelivery, GapQty, GapAmount
FROM            SAI_Work.dbo.QDailyEmail_GAP_New

GO

/****** Object:  View [dbo].[QList_Qustomer]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[QList_Qustomer]
AS
SELECT        COUNT(dbo.M_Product.IDCust) AS Count, dbo.M_Partner.PartnerCode, dbo.M_Partner.PartnerName, dbo.M_Partner.Address, dbo.M_Partner.SysID
FROM            dbo.M_Product INNER JOIN
                         dbo.M_Partner ON dbo.M_Product.IDCust = dbo.M_Partner.SysID
WHERE        (dbo.M_Partner.IsCustomer = 1) AND (dbo.M_Product.IsActive = 1)
GROUP BY dbo.M_Partner.PartnerCode, dbo.M_Partner.PartnerName, dbo.M_Partner.Address, dbo.M_Partner.SysID

GO

/****** Object:  View [dbo].[QM_ChildPart_Conecting2]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[QM_ChildPart_Conecting2]
AS
SELECT        dbo.CMProduct_BOM.SysID, dbo.CMProduct_BOM.ItemID_Product as ItemID, dbo.CMProduct_BOM.ItemID_Product, dbo.CMProduct_BOM.ItemID_BOM, dbo.BOM2.SysID AS Expr1, dbo.BOM2.PartNo, dbo.BOM2.PartName, dbo.BOM2.PartType, dbo.BOM2.LinkID,
                         dbo.BOM2.SpecOrder1, dbo.BOM2.SpecOrder2
FROM            dbo.CMProduct_BOM INNER JOIN
                         dbo.BOM2 ON dbo.CMProduct_BOM.ItemID_BOM = dbo.BOM2.ItemID AND LEFT(dbo.CMProduct_BOM.ItemID_BOM, 3) <> 'SAI'

GO

/****** Object:  View [dbo].[QMaster_Asset]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[QMaster_Asset]
AS
SELECT        dbo.M_Asset.SysID, dbo.M_Asset.ItemID, dbo.M_Asset.ItemNo, dbo.M_Asset.ItemName, dbo.M_Asset.Remark, dbo.M_Asset.CategoryID, dbo.M_Asset.LocationID, dbo.M_Asset.UserID, dbo.M_Asset.DatePur,
                         dbo.M_Asset.LastUpdate, dbo.M_Asset.Qty, dbo.M_Asset.QtyBal, dbo.M_Asset.JurnalID, dbo.M_Asset.IsActive, dbo.M_DetailStatus.Detail AS DetailStatus, dbo.M_Location.Location,
                         dbo.M_Category.category_name AS CategoryName, dbo.M_Asset.Spec, dbo.M_Asset.UnitID, dbo.M_Unit.unit, dbo.M_Asset.Image, dbo.M_Asset.PurchaseDate, dbo.M_Department.Dept_Code,
                         dbo.M_Department.Dept_Name, dbo.M_Asset.Price, dbo.M_Asset.Amount, dbo.M_AssetICT.RAM, M_DetailICT_1.Code AS CodeRAM, dbo.M_AssetICT.HDD, M_DetailICT_4.Code AS CodeHDD,
                         dbo.M_AssetICT.NetCard, M_DetailICT_3.Code AS CodeNetCard, dbo.M_AssetICT.VGACard, M_DetailICT_2.Code AS CodeVGACard, dbo.M_AssetICT.Processor, M_DetailICT_6.Code AS CodeProcessor,
                         dbo.M_AssetICT.OS, M_DetailICT_8.Code AS CodeOS, dbo.M_AssetICT.Office, M_DetailICT_9.Code AS CodeOffice, dbo.M_AssetICT.Autocad, M_DetailICT_10.Code AS CodeAutocad, dbo.M_AssetICT.NX,
                         M_DetailICT_7.Code AS CodeNX, dbo.M_AssetICT.SW, M_DetailICT_5.Code AS CodeSW, dbo.M_AssetICT.Catia, M_DetailICT_12.Code AS CodeCatia, dbo.M_AssetICT.FB, M_DetailICT_11.Code AS CodeFB,
                         dbo.M_AssetICT.DB, M_DetailICT_13.Code AS CodeDB, dbo.M_AssetICT.Hardware, M_DetailICT_16.Code AS CodeHardware, dbo.M_AssetICT.Remark AS RemarkDetail, dbo.M_Asset.VendorID,
                         dbo.M_Partner.PartnerCode, dbo.M_AssetICT.PrinterType, dbo.M_DetailICT.Code AS CodePrinterType, dbo.M_AssetICT.ColorType, M_DetailICT_15.Code AS CodeColorType, dbo.M_AssetICT.SizePaper,
                         M_DetailICT_14.Code AS CodeSizePaper, dbo.M_Partner.PartnerName, dbo.M_Partner.Address, dbo.M_UserG5.DeptID, dbo.M_UserG5.UserName
FROM            dbo.M_DetailICT AS M_DetailICT_1 RIGHT OUTER JOIN
                         dbo.M_DetailICT AS M_DetailICT_3 RIGHT OUTER JOIN
                         dbo.M_DetailICT AS M_DetailICT_10 LEFT OUTER JOIN
                         dbo.M_DetailICT AS M_DetailICT_7 RIGHT OUTER JOIN
                         dbo.M_Unit RIGHT OUTER JOIN
                         dbo.M_Partner RIGHT OUTER JOIN
                         dbo.M_Department RIGHT OUTER JOIN
                         dbo.M_Asset LEFT OUTER JOIN
                         dbo.M_UserG5 ON dbo.M_Asset.UserID = dbo.M_UserG5.RegID ON dbo.M_Department.id = dbo.M_UserG5.DeptID ON dbo.M_Partner.SysID = dbo.M_Asset.VendorID LEFT OUTER JOIN
                         dbo.M_DetailICT RIGHT OUTER JOIN
                         dbo.M_DetailICT AS M_DetailICT_15 RIGHT OUTER JOIN
                         dbo.M_DetailICT AS M_DetailICT_14 RIGHT OUTER JOIN
                         dbo.M_AssetICT ON M_DetailICT_14.SysID = dbo.M_AssetICT.SizePaper ON M_DetailICT_15.SysID = dbo.M_AssetICT.ColorType ON dbo.M_DetailICT.SysID = dbo.M_AssetICT.PrinterType LEFT OUTER JOIN
                         dbo.M_DetailICT AS M_DetailICT_16 ON dbo.M_AssetICT.Hardware = M_DetailICT_16.SysID ON dbo.M_Asset.ItemID = dbo.M_AssetICT.SysID ON dbo.M_Unit.id = dbo.M_Asset.UnitID RIGHT OUTER JOIN
                         dbo.M_Location ON dbo.M_Asset.LocationID = dbo.M_Location.SysID LEFT OUTER JOIN
                         dbo.M_DetailStatus ON dbo.M_Asset.IsActive = dbo.M_DetailStatus.RegID LEFT OUTER JOIN
                         dbo.M_Category ON dbo.M_Asset.CategoryID = dbo.M_Category.id LEFT OUTER JOIN
                         dbo.M_DetailICT AS M_DetailICT_13 ON dbo.M_AssetICT.DB = M_DetailICT_13.SysID LEFT OUTER JOIN
                         dbo.M_DetailICT AS M_DetailICT_11 ON dbo.M_AssetICT.FB = M_DetailICT_11.SysID LEFT OUTER JOIN
                         dbo.M_DetailICT AS M_DetailICT_12 ON dbo.M_AssetICT.Catia = M_DetailICT_12.SysID LEFT OUTER JOIN
                         dbo.M_DetailICT AS M_DetailICT_5 ON dbo.M_AssetICT.SW = M_DetailICT_5.SysID ON M_DetailICT_7.SysID = dbo.M_AssetICT.NX ON M_DetailICT_10.SysID = dbo.M_AssetICT.Autocad LEFT OUTER JOIN
                         dbo.M_DetailICT AS M_DetailICT_9 ON dbo.M_AssetICT.Office = M_DetailICT_9.SysID RIGHT OUTER JOIN
                         dbo.M_DetailICT AS M_DetailICT_8 ON dbo.M_AssetICT.OS = M_DetailICT_8.SysID LEFT OUTER JOIN
                         dbo.M_DetailICT AS M_DetailICT_6 ON dbo.M_AssetICT.Processor = M_DetailICT_6.SysID LEFT OUTER JOIN
                         dbo.M_DetailICT AS M_DetailICT_2 ON dbo.M_AssetICT.VGACard = M_DetailICT_2.SysID ON M_DetailICT_3.SysID = dbo.M_AssetICT.NetCard LEFT OUTER JOIN
                         dbo.M_DetailICT AS M_DetailICT_4 ON dbo.M_AssetICT.HDD = M_DetailICT_4.SysID ON M_DetailICT_1.SysID = dbo.M_AssetICT.RAM

GO

/****** Object:  View [dbo].[QTH_Transaction]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[QTH_Transaction]
AS
SELECT        TH.RegID, TH.DocNum, TH.DocDate, TH.CreateDate, [User].UserName, TH.TrcTypeID, TH.MonthID, TH.TrcID, TH.UserID, COUNT(TD.RegID) AS TotalDetail, TH.PartnerID, TH.DocNum_2, TH.DocDate_2,
                         TH.DocNum_3, TH.StatusID, Partner.Address, TH.RemarkH, SUM(TD.Qty_1) AS TotalQty, TH.DocTime, Partner.PartnerCode, Partner.PartnerName, TH.ShiftID, TH.OP1, TH.OP2, TH.FromAreaID, TH.LineID,
                         TH.PICName, TH.DocDate_Ext
FROM            dbo.TH_Transaction AS TH LEFT OUTER JOIN
                         dbo.M_Partner AS Partner ON TH.PartnerID = Partner.SysID LEFT OUTER JOIN
                         dbo.TD_Transaction AS TD ON TD.TrcID = TH.TrcID AND TD.TrcTypeID = TH.TrcTypeID AND TD.MonthID = TH.MonthID LEFT OUTER JOIN
                         dbo.M_UserG5 AS [User] ON [User].SysID = TH.UserID
WHERE        (TD.IsDelete <> 1)
GROUP BY TH.RegID, TH.DocNum, TH.DocDate, TH.CreateDate, [User].UserName, TH.TrcID, TH.UserID, TH.TrcTypeID, TH.PartnerID, TH.DocNum_2, TH.DocDate_2, TH.DocNum_3, TH.MonthID, TH.StatusID, Partner.Address,
                         TH.RemarkH, TH.DocTime, Partner.PartnerCode, Partner.PartnerName, TH.ShiftID, TH.OP1, TH.OP2, TH.FromAreaID, TH.LineID, TH.PICName, TH.DocDate_Ext
HAVING        (COUNT(TD.RegID) > 0)

GO

/****** Object:  View [dbo].[QTrace_DocNum]    Script Date: 11/27/2017 3:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[QTrace_DocNum]
AS
SELECT        dbo.T500_Proc.C050_DocNum AS DocNum, dbo.T500_Proc.C050_DocDate AS DocDate, dbo.T500_Proc.C045_UserName AS UserName, T500_Proc_1.C050_DocNum AS DocNum2, T500_Proc_1.C050_DocDate AS DocDate2,
                         T500_Proc_1.C045_UserName AS UserName2, dbo.T500_500.C010_TrcTypeID, dbo.T500_500.C011_Month, dbo.T500_500.C000_SysID, dbo.T500_500.C050_Rev, dbo.T500_500.C034_TrcTypeID_To,
                         dbo.T500_500.C035_Month_To, dbo.T500_500.C036_TrcID_To, dbo.T500_500.C050_Rev_To, dbo.T500_Proc.C013_DraftReadyApprCancel, T500_Proc_1.C060_PartnerID
FROM            dbo.T500_Proc INNER JOIN
                         dbo.T500_500 ON dbo.T500_Proc.C010_TrcTypeID = dbo.T500_500.C010_TrcTypeID AND dbo.T500_Proc.C011_Month = dbo.T500_500.C011_Month AND dbo.T500_Proc.C000_SysID = dbo.T500_500.C000_SysID AND
                         dbo.T500_Proc.C050_Rev = dbo.T500_500.C050_Rev INNER JOIN
                         dbo.T500_Proc AS T500_Proc_1 ON dbo.T500_500.C034_TrcTypeID_To = T500_Proc_1.C010_TrcTypeID AND dbo.T500_500.C035_Month_To = T500_Proc_1.C011_Month AND
                         dbo.T500_500.C036_TrcID_To = T500_Proc_1.C000_SysID AND dbo.T500_500.C050_Rev_To = T500_Proc_1.C050_Rev

GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "M_Machine"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 68
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Line"
            Begin Extent =
               Top = 6
               Left = 246
               Bottom = 68
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'DetailMachine'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'DetailMachine'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "M_User"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 225
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_DetailStatus_1"
            Begin Extent =
               Top = 6
               Left = 263
               Bottom = 102
               Right = 433
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Level"
            Begin Extent =
               Top = 6
               Left = 471
               Bottom = 102
               Right = 641
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Department"
            Begin Extent =
               Top = 102
               Left = 263
               Bottom = 232
               Right = 433
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'IMSUser'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'IMSUser'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[33] 4[29] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "M_Department"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 181
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_UserG5"
            Begin Extent =
               Top = 0
               Left = 319
               Bottom = 130
               Right = 489
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'ListPicTR'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'ListPicTR'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[12] 4[49] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "M_Product"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 224
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Partner"
            Begin Extent =
               Top = 6
               Left = 262
               Bottom = 136
               Right = 471
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 12
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'M_CustMaterial'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'M_CustMaterial'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[19] 4[43] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "M_Product"
            Begin Extent =
               Top = 0
               Left = 353
               Bottom = 197
               Right = 539
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Partner"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 247
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 12
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'M_CustWareHouse'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'M_CustWareHouse'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[29] 4[32] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "M_Product"
            Begin Extent =
               Top = 6
               Left = 262
               Bottom = 136
               Right = 448
            End
            DisplayFlags = 280
            TopColumn = 7
         End
         Begin Table = "M_Partner"
            Begin Extent =
               Top = 6
               Left = 486
               Bottom = 136
               Right = 695
            End
            DisplayFlags = 280
            TopColumn = 4
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 12
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'M_CustWIP'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'M_CustWIP'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "BOM1"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Customer"
            Begin Extent =
               Top = 6
               Left = 246
               Bottom = 136
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Partner"
            Begin Extent =
               Top = 6
               Left = 454
               Bottom = 136
               Right = 624
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "BOM6"
            Begin Extent =
               Top = 138
               Left = 38
               Bottom = 251
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Project"
            Begin Extent =
               Top = 138
               Left = 246
               Bottom = 251
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Master_BOM1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Master_BOM1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Master_BOM1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[11] 2[19] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "WareHouseStock"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 137
               Right = 224
            End
            DisplayFlags = 280
            TopColumn = 9
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 15
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 2250
         Alias = 1875
         Table = 2880
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'MonitoringFG'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'MonitoringFG'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'MonitoringFGListCust'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'MonitoringFGListCust'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "T_77_MLedger"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q_77_MLedger_CashBank'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q_77_MLedger_CashBank'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "T_77_MLedger"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q_77_MLedger_Detail'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q_77_MLedger_Detail'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "M_Partner"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 231
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T077_PostCategory"
            Begin Extent =
               Top = 6
               Left = 269
               Bottom = 136
               Right = 439
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Q093_CostCenter"
            Begin Extent =
               Top = 6
               Left = 477
               Bottom = 136
               Right = 647
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T500_Proc"
            Begin Extent =
               Top = 6
               Left = 685
               Bottom = 136
               Right = 925
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Q680_SummaryBudget"
            Begin Extent =
               Top = 6
               Left = 963
               Bottom = 119
               Right = 1133
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T_77_MLedger"
            Begin Extent =
               Top = 120
               Left = 963
               Bottom = 250
               Right = 1133
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T100_FixedAsset"
            Begin Extent =
               Top = 138
               Left = 38
               Bottom = 268
               Right = 216
     ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q_G1_Proc'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'       End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T106_FA_Activity"
            Begin Extent =
               Top = 138
               Left = 254
               Bottom = 268
               Right = 442
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T_77_MLedger_Sub1"
            Begin Extent =
               Top = 138
               Left = 480
               Bottom = 268
               Right = 650
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T064_PRCategory"
            Begin Extent =
               Top = 138
               Left = 688
               Bottom = 268
               Right = 858
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Currency"
            Begin Extent =
               Top = 252
               Left = 896
               Bottom = 382
               Right = 1066
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q_G1_Proc'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q_G1_Proc'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[17] 4[57] 2[5] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "T510_Proc"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 243
               Right = 249
            End
            DisplayFlags = 280
            TopColumn = 11
         End
         Begin Table = "Q01_MProduct"
            Begin Extent =
               Top = 0
               Left = 453
               Bottom = 229
               Right = 623
            End
            DisplayFlags = 280
            TopColumn = 41
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 49
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 2445
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Wid' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q_G2_Proc'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'th = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 4860
         Alias = 2970
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q_G2_Proc'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q_G2_Proc'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[22] 4[39] 2[9] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "T094_CostCenterDetail"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T510_Proc"
            Begin Extent =
               Top = 6
               Left = 246
               Bottom = 136
               Right = 457
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T064_PRCategory"
            Begin Extent =
               Top = 6
               Left = 495
               Bottom = 136
               Right = 665
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T077_PostCategory"
            Begin Extent =
               Top = 6
               Left = 703
               Bottom = 136
               Right = 873
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Unit_1"
            Begin Extent =
               Top = 6
               Left = 911
               Bottom = 136
               Right = 1081
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Product"
            Begin Extent =
               Top = 6
               Left = 1119
               Bottom = 136
               Right = 1289
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Currency"
            Begin Extent =
               Top = 138
               Left = 38
               Bottom = 268
               Right = 208
            E' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q_G2_Proc_Other'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'nd
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Unit"
            Begin Extent =
               Top = 138
               Left = 246
               Bottom = 268
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 3300
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q_G2_Proc_Other'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q_G2_Proc_Other'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[49] 4[26] 2[5] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = -192
         Left = 0
      End
      Begin Tables =
         Begin Table = "M_Currency"
            Begin Extent =
               Top = 53
               Left = 1041
               Bottom = 183
               Right = 1211
            End
            DisplayFlags = 280
            TopColumn = 3
         End
         Begin Table = "M_Unit"
            Begin Extent =
               Top = 32
               Left = 922
               Bottom = 162
               Right = 1092
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "QM_UserG5"
            Begin Extent =
               Top = 184
               Left = 248
               Bottom = 428
               Right = 440
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Partner"
            Begin Extent =
               Top = 0
               Left = 247
               Bottom = 175
               Right = 440
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Project"
            Begin Extent =
               Top = 0
               Left = 0
               Bottom = 113
               Right = 170
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Unit_1"
            Begin Extent =
               Top = 437
               Left = 246
               Bottom = 595
               Right = 440
            End
            DisplayFlags = 280
            TopColumn = 1
         End
         Begin Table = "M_Category"
            Begin Extent =
               Top = 123
               Left = 0
               Bottom = 253
               Right = 170
            End
            Displ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q01_MProduct'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'ayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Product"
            Begin Extent =
               Top = 0
               Left = 656
               Bottom = 339
               Right = 826
            End
            DisplayFlags = 280
            TopColumn = 27
         End
         Begin Table = "T077_PostCategory"
            Begin Extent =
               Top = 227
               Left = 958
               Bottom = 432
               Right = 1128
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 63
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 2895
         Alias = 2325
         Table = 2265
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q01_MProduct'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q01_MProduct'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "T077_PostCategory"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T066_ItemGroup"
            Begin Extent =
               Top = 6
               Left = 246
               Bottom = 102
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T_77_MLedger"
            Begin Extent =
               Top = 71
               Left = 452
               Bottom = 201
               Right = 622
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "PR_DocType"
            Begin Extent =
               Top = 6
               Left = 662
               Bottom = 136
               Right = 832
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q077_PostCategory'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q077_PostCategory'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[36] 4[30] 2[21] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "T093_CostCenter"
            Begin Extent =
               Top = 0
               Left = 6
               Bottom = 239
               Right = 176
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Q094_CostCenterDetail_Sum"
            Begin Extent =
               Top = 170
               Left = 341
               Bottom = 294
               Right = 640
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Q680_SummaryBudget"
            Begin Extent =
               Top = 110
               Left = 529
               Bottom = 260
               Right = 767
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T015_Department"
            Begin Extent =
               Top = 0
               Left = 536
               Bottom = 152
               Right = 706
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 11
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 2265
         Alias = 2625
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
    ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q093_CostCenter'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'     Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q093_CostCenter'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q093_CostCenter'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "T094_CostCenterDetail"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 224
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 12
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q094_CostCenterDetail'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q094_CostCenterDetail'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "T094_CostCenterDetail"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 224
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 12
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q094_CostCenterDetail_Sum'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q094_CostCenterDetail_Sum'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[30] 4[32] 2[13] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "T106_FA_Activity"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 226
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T100_FixedAsset"
            Begin Extent =
               Top = 6
               Left = 264
               Bottom = 136
               Right = 442
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T101_GroupAsset"
            Begin Extent =
               Top = 6
               Left = 480
               Bottom = 136
               Right = 650
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T105_ActivityCategory"
            Begin Extent =
               Top = 6
               Left = 688
               Bottom = 119
               Right = 858
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T015_Department"
            Begin Extent =
               Top = 6
               Left = 896
               Bottom = 119
               Right = 1066
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Co' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q106_FA_Activity_InProgress'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'lumn = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q106_FA_Activity_InProgress'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q106_FA_Activity_InProgress'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "T610_Trc"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 232
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T_77_MLedger_Sub2"
            Begin Extent =
               Top = 6
               Left = 270
               Bottom = 136
               Right = 440
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T_77_MLedger_Sub1"
            Begin Extent =
               Top = 6
               Left = 478
               Bottom = 136
               Right = 648
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T_77_MLedger"
            Begin Extent =
               Top = 6
               Left = 686
               Bottom = 136
               Right = 856
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T_76_SLedger"
            Begin Extent =
               Top = 6
               Left = 894
               Bottom = 102
               Right = 1064
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
   ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q610_Jurnal'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'      Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q610_Jurnal'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q610_Jurnal'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "T680_Trc"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 229
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 12
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q680_SummaryBudget'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'Q680_SummaryBudget'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[8] 4[53] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "CMProduct_BOM"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 209
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "BOM1"
            Begin Extent =
               Top = 6
               Left = 247
               Bottom = 136
               Right = 417
            End
            DisplayFlags = 280
            TopColumn = 2
         End
         Begin Table = "M_Project"
            Begin Extent =
               Top = 138
               Left = 246
               Bottom = 251
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Partner"
            Begin Extent =
               Top = 6
               Left = 455
               Bottom = 136
               Right = 648
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QCMProduct_BOM1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QCMProduct_BOM1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[15] 4[47] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "CMProduct_BOM"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 209
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "BOM2"
            Begin Extent =
               Top = 11
               Left = 289
               Bottom = 202
               Right = 473
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "BOM1"
            Begin Extent =
               Top = 0
               Left = 579
               Bottom = 152
               Right = 749
            End
            DisplayFlags = 280
            TopColumn = 4
         End
         Begin Table = "M_Partner"
            Begin Extent =
               Top = 6
               Left = 854
               Bottom = 164
               Right = 1047
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Project"
            Begin Extent =
               Top = 6
               Left = 1085
               Bottom = 119
               Right = 1255
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 12
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QCMProduct_BOM2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QCMProduct_BOM2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QCMProduct_BOM2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "QDailyEmail_GAP_New (SAI_Work.dbo)"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 213
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QDailyEmail_GAP_New'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QDailyEmail_GAP_New'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[29] 4[37] 2[7] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "M_Product"
            Begin Extent =
               Top = 0
               Left = 10
               Bottom = 158
               Right = 196
            End
            DisplayFlags = 280
            TopColumn = 7
         End
         Begin Table = "M_Partner"
            Begin Extent =
               Top = 0
               Left = 305
               Bottom = 130
               Right = 514
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 12
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QList_Qustomer'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QList_Qustomer'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[41] 4[20] 2[11] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "M_ChildPart_Conecting"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 166
               Right = 221
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Q01_MProduct"
            Begin Extent =
               Top = 6
               Left = 259
               Bottom = 186
               Right = 429
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QM_ChildPart_Conecting'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QM_ChildPart_Conecting'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "M_UserG5"
            Begin Extent =
               Top = 6
               Left = 246
               Bottom = 136
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Location"
            Begin Extent =
               Top = 6
               Left = 454
               Bottom = 136
               Right = 624
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Department"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 1
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QM_UserG5'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QM_UserG5'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "QM_UserG5"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 68
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_UserRole"
            Begin Extent =
               Top = 6
               Left = 246
               Bottom = 68
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T_30_ActMgr"
            Begin Extent =
               Top = 89
               Left = 284
               Bottom = 151
               Right = 454
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T_30_UserGrpFlow"
            Begin Extent =
               Top = 6
               Left = 454
               Bottom = 68
               Right = 624
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QM_UserRole'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QM_UserRole'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[5] 4[54] 2[5] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = -192
         Left = -212
      End
      Begin Tables =
         Begin Table = "M_Location"
            Begin Extent =
               Top = 6
               Left = 454
               Bottom = 136
               Right = 624
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Unit"
            Begin Extent =
               Top = 138
               Left = 38
               Bottom = 268
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_AssetICT"
            Begin Extent =
               Top = 270
               Left = 246
               Bottom = 332
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 8
         End
         Begin Table = "M_Department"
            Begin Extent =
               Top = 457
               Left = 606
               Bottom = 587
               Right = 776
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Category"
            Begin Extent =
               Top = 498
               Left = 454
               Bottom = 628
               Right = 624
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Asset"
            Begin Extent =
               Top = 318
               Left = 245
               Bottom = 482
               Right = 415
            End
            DisplayFlags = 280
            TopColumn = 8
         End
         Begin Table = "M_DetailStatus"
            Begin Extent =
               Top = 402
               Left = 454
               Bottom = 498
               Right = 624
            End
   ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QMaster_Asset'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'         DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Partner"
            Begin Extent =
               Top = 421
               Left = 606
               Bottom = 613
               Right = 776
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_UserG5"
            Begin Extent =
               Top = 195
               Left = 933
               Bottom = 369
               Right = 1103
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_DetailICT_9"
            Begin Extent =
               Top = 6
               Left = 246
               Bottom = 136
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_DetailICT_10"
            Begin Extent =
               Top = 762
               Left = 454
               Bottom = 892
               Right = 624
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_DetailICT"
            Begin Extent =
               Top = 138
               Left = 246
               Bottom = 268
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_DetailICT_15"
            Begin Extent =
               Top = 138
               Left = 454
               Bottom = 268
               Right = 624
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_DetailICT_14"
            Begin Extent =
               Top = 270
               Left = 38
               Bottom = 400
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_DetailICT_16"
            Begin Extent =
               Top = 270
               Left = 454
               Bottom = 400
               Right = 624
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_DetailICT_13"
            Begin Extent =
               Top = 534
               Left = 246
               Bottom = 664
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_DetailICT_11"
            Begin Extent =
               Top = 600
               Left = 38
               Bottom = 730
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_DetailICT_12"
            Begin Extent =
               Top = 630
               Left = 454
               Bottom = 760
               Right = 624
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_DetailICT_5"
            Begin Extent =
               Top = 666
               Left = 246
               Bottom = 796
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_DetailICT_7"
            Begin Extent =
               Top = 732
               Left = 38
               Bottom = 862
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_DetailICT_8"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 208
            En' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QMaster_Asset'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane3', @value=N'd
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_DetailICT_6"
            Begin Extent =
               Top = 798
               Left = 246
               Bottom = 928
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_DetailICT_2"
            Begin Extent =
               Top = 864
               Left = 38
               Bottom = 994
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_DetailICT_3"
            Begin Extent =
               Top = 894
               Left = 454
               Bottom = 1024
               Right = 624
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_DetailICT_4"
            Begin Extent =
               Top = 930
               Left = 246
               Bottom = 1060
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_DetailICT_1"
            Begin Extent =
               Top = 996
               Left = 38
               Bottom = 1126
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 69
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QMaster_Asset'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=3 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QMaster_Asset'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[37] 4[24] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "QCMProduct_BOM"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 209
            End
            DisplayFlags = 280
            TopColumn = 9
         End
         Begin Table = "QTD_Transaction"
            Begin Extent =
               Top = 6
               Left = 247
               Bottom = 183
               Right = 439
            End
            DisplayFlags = 280
            TopColumn = 87
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 1815
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QRM_DetailTrc'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QRM_DetailTrc'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[69] 4[5] 2[11] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "TD_Transaction"
            Begin Extent =
               Top = 0
               Left = 0
               Bottom = 306
               Right = 170
            End
            DisplayFlags = 280
            TopColumn = 35
         End
         Begin Table = "TH_Transaction"
            Begin Extent =
               Top = 0
               Left = 398
               Bottom = 193
               Right = 568
            End
            DisplayFlags = 280
            TopColumn = 6
         End
         Begin Table = "QM_UserG5"
            Begin Extent =
               Top = 1
               Left = 604
               Bottom = 314
               Right = 774
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Q01_MProduct"
            Begin Extent =
               Top = 0
               Left = 168
               Bottom = 227
               Right = 338
            End
            DisplayFlags = 280
            TopColumn = 52
         End
         Begin Table = "T_Connecting"
            Begin Extent =
               Top = 133
               Left = 577
               Bottom = 356
               Right = 747
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "TD_Transaction_1"
            Begin Extent =
               Top = 130
               Left = 721
               Bottom = 325
               Right = 898
            End
            DisplayFlags = 280
            TopColumn = 42
         End
         Begin Table = "Q01_MProduct_1"
            Begin Extent =
               Top = 6
               Left = 1039
               Bottom = 195
               Right = 1209
       ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QTD_Transaction'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'     End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Partner"
            Begin Extent =
               Top = 213
               Left = 293
               Bottom = 371
               Right = 486
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Partner_1"
            Begin Extent =
               Top = 0
               Left = 730
               Bottom = 232
               Right = 923
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "QM_UserG5_1"
            Begin Extent =
               Top = 257
               Left = 227
               Bottom = 387
               Right = 397
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 113
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 3945
         Alias = 1950
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QTD_Transaction'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane3', @value=N'
         Table = 2520
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QTD_Transaction'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=3 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QTD_Transaction'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[9] 4[60] 2[5] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1[35] 4[36] 3) )"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = -480
         Left = 0
      End
      Begin Tables =
         Begin Table = "M_Partner"
            Begin Extent =
               Top = 797
               Left = 183
               Bottom = 1121
               Right = 352
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Product"
            Begin Extent =
               Top = 349
               Left = 188
               Bottom = 789
               Right = 358
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "TD_Transaction"
            Begin Extent =
               Top = 9
               Left = 0
               Bottom = 628
               Right = 170
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "TH_Transaction"
            Begin Extent =
               Top = 9
               Left = 184
               Bottom = 342
               Right = 354
            End
            DisplayFlags = 280
            TopColumn = 7
         End
         Begin Table = "M_Partner_2"
            Begin Extent =
               Top = 237
               Left = 370
               Bottom = 367
               Right = 540
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Partner_1"
            Begin Extent =
               Top = 634
               Left = 0
               Bottom = 1126
               Right = 170
            End
            DisplayFlags = 280
            TopColumn = 7
         End
         Begin Table = "M_UserG5"
            Begin Extent =
               Top = 376
               Left = 369
               Bottom = 526
               Right = 536
            End
   ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QTD_Transaction1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'         DisplayFlags = 280
            TopColumn = 1
         End
         Begin Table = "M_Department_1"
            Begin Extent =
               Top = 175
               Left = 787
               Bottom = 305
               Right = 957
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Department"
            Begin Extent =
               Top = 313
               Left = 794
               Bottom = 512
               Right = 964
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_UserG5_1"
            Begin Extent =
               Top = 242
               Left = 570
               Bottom = 372
               Right = 740
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "TD_Transaction_1"
            Begin Extent =
               Top = 7
               Left = 573
               Bottom = 231
               Right = 743
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Q01_MProduct"
            Begin Extent =
               Top = 10
               Left = 780
               Bottom = 165
               Right = 950
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T_Connecting"
            Begin Extent =
               Top = 9
               Left = 369
               Bottom = 230
               Right = 539
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Project"
            Begin Extent =
               Top = 538
               Left = 367
               Bottom = 651
               Right = 537
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_MaterialType"
            Begin Extent =
               Top = 672
               Left = 370
               Bottom = 768
               Right = 540
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Unit"
            Begin Extent =
               Top = 783
               Left = 377
               Bottom = 913
               Right = 547
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Category"
            Begin Extent =
               Top = 396
               Left = 572
               Bottom = 648
               Right = 742
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 108
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         W' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QTD_Transaction1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane3', @value=N'idth = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1950
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 3270
         Alias = 3450
         Table = 2415
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 2130
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QTD_Transaction1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=3 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QTD_Transaction1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[51] 4[6] 2[5] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "TH"
            Begin Extent =
               Top = 11
               Left = 0
               Bottom = 227
               Right = 186
            End
            DisplayFlags = 280
            TopColumn = 4
         End
         Begin Table = "TD"
            Begin Extent =
               Top = 0
               Left = 409
               Bottom = 313
               Right = 595
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "User"
            Begin Extent =
               Top = 105
               Left = 496
               Bottom = 235
               Right = 682
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Partner"
            Begin Extent =
               Top = 150
               Left = 572
               Bottom = 370
               Right = 758
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 23
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 12
        ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QTH_Transaction'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N' Column = 1440
         Alias = 1965
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QTH_Transaction'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QTH_Transaction'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "T500_Proc"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 278
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T500_500"
            Begin Extent =
               Top = 6
               Left = 316
               Bottom = 136
               Right = 515
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "T500_Proc_1"
            Begin Extent =
               Top = 6
               Left = 553
               Bottom = 204
               Right = 793
            End
            DisplayFlags = 280
            TopColumn = 24
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QTrace_DocNum'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'QTrace_DocNum'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[12] 4[52] 2[9] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "M_Product"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 194
               Right = 224
            End
            DisplayFlags = 280
            TopColumn = 45
         End
         Begin Table = "SCMaterial_IN"
            Begin Extent =
               Top = 6
               Left = 262
               Bottom = 136
               Right = 448
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Partner"
            Begin Extent =
               Top = 99
               Left = 366
               Bottom = 229
               Right = 575
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 22
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 12
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
      ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'RMStock'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'   Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'RMStock'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'RMStock'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "M_Category"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Product"
            Begin Extent =
               Top = 6
               Left = 246
               Bottom = 136
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "SCGA_Ext"
            Begin Extent =
               Top = 6
               Left = 454
               Bottom = 136
               Right = 624
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCGA'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCGA'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCGA_Ext'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCGA_Ext'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "QTD_Transaction"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 230
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCGA_IN'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCGA_IN'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "QTD_Transaction"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 230
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCGA_OUT'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCGA_OUT'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[38] 4[23] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "M_Category"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Product"
            Begin Extent =
               Top = 6
               Left = 246
               Bottom = 136
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "SCICT_Ext"
            Begin Extent =
               Top = 6
               Left = 454
               Bottom = 136
               Right = 624
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 24
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
        ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCICT'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N' Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCICT'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCICT'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCICT_Ext'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCICT_Ext'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "QTD_Transaction"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 230
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCICT_IN'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCICT_IN'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "QTD_Transaction"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 230
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCICT_OUT'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCICT_OUT'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[21] 4[44] 2[7] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "QTD_Transaction"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 163
               Right = 214
            End
            DisplayFlags = 280
            TopColumn = 88
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 24
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCMaterial_IN'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCMaterial_IN'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[21] 4[23] 2[26] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "QTD_Transaction"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 230
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 24
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 13
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCMaterial_OUT'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCMaterial_OUT'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[24] 4[11] 2[38] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "SCRawMaterial_Ext"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 197
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 13
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCRawMaterial'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCRawMaterial'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[41] 4[10] 2[19] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 22
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCRawMaterial_Ext'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCRawMaterial_Ext'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[14] 4[34] 2[34] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "SCToolRoom_Ext"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 197
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Product"
            Begin Extent =
               Top = 6
               Left = 246
               Bottom = 177
               Right = 416
            End
            DisplayFlags = 280
            TopColumn = 7
         End
         Begin Table = "M_Category"
            Begin Extent =
               Top = 6
               Left = 454
               Bottom = 136
               Right = 624
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 24
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
   ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCToolRoom'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'      Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCToolRoom'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCToolRoom'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[41] 4[20] 2[12] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 21
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCToolRoom_Ext'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCToolRoom_Ext'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "QTD_Transaction"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 202
               Right = 230
            End
            DisplayFlags = 280
            TopColumn = 87
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCToolRoom_IN'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCToolRoom_IN'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[41] 4[20] 2[10] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "QTD_Transaction"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 203
               Right = 230
            End
            DisplayFlags = 280
            TopColumn = 92
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCToolRoom_OUT'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCToolRoom_OUT'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "SCWareHouse_Ext"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 13
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCWareHouse'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCWareHouse'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 13
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCWareHouse_Ext'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCWareHouse_Ext'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "QTD_Transaction"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 230
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCWareHouse_IN'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCWareHouse_IN'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "QTD_Transaction"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 230
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCWareHouse_OUT'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCWareHouse_OUT'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[41] 4[20] 2[13] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "SCWIP_Ext"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 21
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCWIP'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCWIP'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[41] 4[20] 2[17] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 21
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCWIP_Ext'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCWIP_Ext'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[12] 4[49] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "QTD_Transaction"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 230
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 24
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCWIP_IN'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCWIP_IN'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "QTD_Transaction"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 230
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCWIP_OUT'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SCWIP_OUT'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[20] 4[42] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "M_Product"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 224
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Category"
            Begin Extent =
               Top = 6
               Left = 262
               Bottom = 136
               Right = 448
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "SCGA_IN"
            Begin Extent =
               Top = 6
               Left = 486
               Bottom = 136
               Right = 672
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Customer"
            Begin Extent =
               Top = 6
               Left = 710
               Bottom = 136
               Right = 896
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 12
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'StockGA'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'StockGA'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[16] 4[45] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "M_Product"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 224
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Category"
            Begin Extent =
               Top = 6
               Left = 262
               Bottom = 136
               Right = 448
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "SCICT_IN"
            Begin Extent =
               Top = 6
               Left = 486
               Bottom = 136
               Right = 672
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Customer"
            Begin Extent =
               Top = 6
               Left = 710
               Bottom = 136
               Right = 896
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 12
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'StockICT'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'StockICT'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[7] 4[56] 2[10] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "M_Product"
            Begin Extent =
               Top = 0
               Left = 0
               Bottom = 205
               Right = 186
            End
            DisplayFlags = 280
            TopColumn = 4
         End
         Begin Table = "M_Category"
            Begin Extent =
               Top = 120
               Left = 403
               Bottom = 304
               Right = 589
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "SCToolRoom_IN"
            Begin Extent =
               Top = 6
               Left = 262
               Bottom = 136
               Right = 448
            End
            DisplayFlags = 280
            TopColumn = 21
         End
         Begin Table = "M_Customer"
            Begin Extent =
               Top = 6
               Left = 486
               Bottom = 136
               Right = 672
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 23
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin C' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'StockTR'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'olumnWidths = 12
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'StockTR'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'StockTR'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "QTD_Transaction"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 169
               Right = 214
            End
            DisplayFlags = 280
            TopColumn = 59
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SumRM'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'SumRM'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[47] 4[16] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "WareHouseStock_Ext"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 136
               Right = 224
            End
            DisplayFlags = 280
            TopColumn = 9
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 14
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 12
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'WareHouseStock'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'WareHouseStock'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[26] 4[53] 2[7] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "M_DetailStatus"
            Begin Extent =
               Top = 6
               Left = 38
               Bottom = 102
               Right = 224
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Product"
            Begin Extent =
               Top = 6
               Left = 262
               Bottom = 191
               Right = 448
            End
            DisplayFlags = 280
            TopColumn = 6
         End
         Begin Table = "M_Project"
            Begin Extent =
               Top = 6
               Left = 934
               Bottom = 119
               Right = 1120
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "SCWareHouse"
            Begin Extent =
               Top = 6
               Left = 710
               Bottom = 136
               Right = 896
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "M_Partner"
            Begin Extent =
               Top = 6
               Left = 486
               Bottom = 136
               Right = 695
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 14
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
  ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'WareHouseStock_Ext'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'    End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 12
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'WareHouseStock_Ext'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'WareHouseStock_Ext'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties =
   Begin PaneConfigurations =
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[15] 4[37] 2[5] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane =
      Begin Origin =
         Top = 0
         Left = 0
      End
      Begin Tables =
         Begin Table = "M_Product"
            Begin Extent =
               Top = 0
               Left = 46
               Bottom = 161
               Right = 232
            End
            DisplayFlags = 280
            TopColumn = 8
         End
         Begin Table = "M_Project"
            Begin Extent =
               Top = 55
               Left = 880
               Bottom = 168
               Right = 1066
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "SCWIP"
            Begin Extent =
               Top = 0
               Left = 619
               Bottom = 130
               Right = 805
            End
            DisplayFlags = 280
            TopColumn = 4
         End
         Begin Table = "M_Partner"
            Begin Extent =
               Top = 62
               Left = 276
               Bottom = 192
               Right = 485
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane =
   End
   Begin DataPane =
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 14
         Width = 284
         Width = 1500
         Width = 1500
         Width = 2670
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane =
      Begin ColumnWidths = 12
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
   ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'WIPStock'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'      GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'WIPStock'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'WIPStock'
GO

