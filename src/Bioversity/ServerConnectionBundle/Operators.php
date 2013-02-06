<?php

namespace Bioversity\ServerConnectionBundle\Repository;

class Operators{
    const kOPERATOR_DISABLED=		'$NO';			// Disabled.
    const kOPERATOR_EQUAL=		'$EQ';			// Equals.
    const kOPERATOR_EQUAL_NOT=		'$NE';			// Not equal.
    const kOPERATOR_LIKE=		'$AS';			// Like.
    const kOPERATOR_LIKE_NOT=		'$NS';			// Not like.
    const kOPERATOR_PREFIX=		'$PX';			// Starts with.
    const kOPERATOR_PREFIX_NOCASE=	'$PXi';			// Starts with no-case.
    const kOPERATOR_CONTAINS=		'$CX';			// Contains.
    const kOPERATOR_CONTAINS_NOCASE=	'$CXi';			// Contains with no-case.
    const kOPERATOR_SUFFIX=		'$SX';			// Ends with.
    const kOPERATOR_SUFFIX_NOCASE=	'$SXi';			// Ends with with no-case.
    const kOPERATOR_REGEX=		'$RE';			// Regular expression.
    const kOPERATOR_LESS=		'$LT';			// Less than.
    const kOPERATOR_LESS_EQUAL=		'$LE';			// Less than or equal.
    const kOPERATOR_GREAT=		'$GT';			// Greater than.
    const kOPERATOR_GREAT_EQUAL=	'$GE';			// Greater than or equal.
    const kOPERATOR_IRANGE=		'$IRG';			// Range inclusive.
    const kOPERATOR_ERANGE=		'$ERG';			// Range exclusive.
    const kOPERATOR_NULL=		'$NU';			// Empty or null.
    const kOPERATOR_NOT_NULL=		'$NN';			// Not empty or null.
    const kOPERATOR_IN=			'$IN';			// Belongs to.
    const kOPERATOR_NI=			'$NI';			// Does not belong to.
    const kOPERATOR_ALL=		'$AL';			// All.
    const kOPERATOR_NALL=		'$NAL';			// Not all.
    const kOPERATOR_EX=			'$EX';			// Expression.
    const kOPERATOR_AND=		'$AND';
    const kOPERATOR_NAND=		'$NAND';
    const kOPERATOR_OR=			'$OR';
    const kOPERATOR_NOR=		'$NOR';

}